<?php

namespace App\Http\Controllers;

use App\Classes\MailService;
use App\Classes\RechargeManager;
use App\Model\Cart;
use App\Model\Circle;
use App\Model\Operators;
use App\Model\Order;
use App\Model\Products;
use App\Model\RechargeHistory;
use App\Model\Services;
use App\Model\ShippingAddress;
use App\Model\User;
use App\Model\WalletHistory;
use Doctrine\DBAL\Tools\Console\Command\ReservedWordsCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Softon\Indipay\Facades\Indipay;

class RechargeController extends Controller
{
    /**
     * @var RechargeManager
     */
    private $rechargeManager;

    protected $user;
    /**
     * @var MailService
     */
    private $mailService;

    public function __construct(RechargeManager $rechargeManager, MailService $mailService)
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            if (auth()->user() && auth()->user()->hasRole('admin') || auth()->user() && auth()->user()->hasRole('seller')) {
                Auth::logout();
                return redirect('/');
            }
            return $next($request);
        });
        $this->rechargeManager = $rechargeManager;
        $this->mailService = $mailService;
    }

    public function getPrepaidRecharge()
    {
        $prepaid = Operators::select('operators.id', 'operators.name')
            ->join('services', 'services.id', 'operators.service_id')
            ->where('services.name', RechargeHistory::PREPAIDRECHARGE)
            ->where('operators.status', 1)
            ->get();

        $circles = Circle::select('id', 'name', 'code')->get();

        return view('front.pages.recharge.prepaid_recharge', compact('prepaid', 'circles'));
    }

    public function getPostpaidRecharge()
    {
        $postpaid = Operators::select('operators.id', 'operators.name')
            ->join('services', 'services.id', 'operators.service_id')
            ->where('services.name', RechargeHistory::POSTPAIDRECHARGE)
            ->where('operators.status', 1)
            ->get();
        $circles = Circle::select('id', 'name', 'code')->get();

        return view('front.pages.recharge.postpaid_recharge', compact('postpaid', 'circles'));
    }

    public function postRecharge(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'recharge_num' => 'required|regex:/[0-9]{10}/|digits:10',
            'operator' => 'required',
            'amount' => 'required|integer',
            'circle' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }

        $recharge = new RechargeHistory();
        $this->rechargeManager->saveRechargeDetails($recharge, $request->get('recharge_num'), $request->get('operator'), $request->get('circle'), $request->get('amount'));
        $service = Services::where('name', $request->get('type'))->first();
        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found..!'
            ]);
        }
        $recharge->service_id = $service->id;
        $recharge->save();

        return response()->json([
            'success' => true,
            'url' => route('get:order_page', $recharge->transaction_id)
        ]);
    }

    public function postCheckout(Request $request)
    {
        $recharge = RechargeHistory::select('recharge_history.*', 'operators.op_code')
            ->join('operators', 'operators.id', '=', 'recharge_history.operator_id')
            ->where('transaction_id', $request->get('transactionId'))
            ->where('user_id', Auth::user()->id)
            ->first();
        if (!$recharge) {
            return response()->json([
                'success' => false,
                'message' => 'Something is wrong please try again..!'
            ]);
        }
        
        $myurl = "http://response.rcpanel.com/api_users/recharge?username=110298&pwd=3y691ai0&circlecode=12&operatorcode=" . $recharge->op_code . "&number=" . $recharge->recharge_num . "&amount=" . $request->get('amount') . "&orderid=" . $recharge->transaction_id . "";
        $result = $this->rechargeManager->curl_get($myurl);
        $myArray = explode('#', $result);

        $recharge->res_trans_id = $myArray[0];
        $recharge->status = $myArray[1];
        $recharge->operator = $myArray[2];
        $recharge->save();

        if ($myArray[1] == 'Pending') {
            $myurl1 = "http://response.rcpanel.com/api_users/status?username=110298&pwd=3y691ai0&orderid=" . $recharge->transaction_id . "&txnid=" . $recharge->res_trans_id . "";
            $status = $this->rechargeManager->curl_get($myurl1);
            $myArray = explode('#', $status);
            $recharge->status = $myArray[0];
            $recharge->operator = $myArray[1];
            $recharge->save();
        }
        if ($recharge->status == 'Success') {
            $user = Auth::user();
            $user->wallet_amount = $user->wallet_amount - $result->get('amount');
            $user->save();

            $operator = Operators::find($recharge->operator_id);
            $data = array('username' => $user->username, 'email' => $user->email, 'mobile_num' => $recharge->recharge_num, 'amount' => $recharge->amount, 'status' => $recharge->status, 'operator' => $operator->name);
            $this->mailService->sendRechargeMail($data, $user);

            Session::flash('suucess', 'Recharge successfully done..!');
        } elseif ($recharge->status == 'Failure') {
            Session::flash('error', 'Recharge fail..!');
        } else {
            Session::flash('success', 'Recharge pending..!');
        }
        return response()->json([
            'success' => true,
            'url' => route('get:order_page', $recharge->transaction_id)
        ]);
    }

    public function getProcessTransaction($transactionId)
    {
        $recharge = RechargeHistory::select('recharge_history.*')
            ->where('transaction_id', $transactionId)
            ->where('user_id', Auth::user()->id)
            ->first();

        if (!$recharge) {
            Session::flash('error', 'Something is wrong please try again..!');
            return redirect()->back();
        }
        return view('front.pages.process_transaction', compact('recharge'));
    }

    public function getRechargePayment(Request $request)
    {
        $recharge = RechargeHistory::select('recharge_history.*', 'users.email')
            ->join('users', 'users.id', '=', 'recharge_history.user_id')
            ->where('transaction_id', $request->get('transId'))
            ->where('recharge_history.user_id', Auth::user()->id)
            ->first();
        if (!$recharge) {
            Session::flash('error', 'Recharge failed..!');
            return redirect()->back();
        }

        if(Auth::user()->mobile_num != 9624949788){
            Session::flash('error', "Sorry can't recharge for this number");
            return redirect()->back();
        }

        if ($request->get('amount')) {
            $amount = $request->get('amount');
        } else {
            $amount = $recharge->amount;
        }
        $user = User::find($recharge->user_id);
        if ($user->wallet_amount > $recharge->amount) {
            $wallet = '';
        } else {
            $wallet = $user->wallet_amount;
        }

        $parameters = [
            'merchant_id' => env('INDIPAY_MERCHANT_ID'),
            'currency' => 'INR',
            'redirect_url' => env('APP_URL') . '/indipay/response',
            'cancel_url' => env('APP_URL') . '/indipay/response',
            'language' => 'EN',
            'tid' => $recharge->transaction_id,
            'order_id' => $recharge->transaction_id,
            'email' => $recharge->email,
            'phone' => $recharge->recharge_num,
            'amount' => "$amount",
            'merchant_param1' => "$wallet",
        ];

        $order = Indipay::gateway('CCAvenue')->prepare($parameters);
        return Indipay::process($order);
    }

    public function getIndipayResponse(Request $request)
    {
        $response = Indipay::gateway('CCAvenue')->response($request);
        $recharge = RechargeHistory::select('recharge_history.*', 'operators.op_code')
            ->join('operators', 'operators.id', '=', 'recharge_history.operator_id')
            ->where('transaction_id', $response['order_id'])
            ->limit(1)->first();
        if (!$recharge) {
            $orders = Order::select('order.id', 'order.transaction_id', 'order.product_id', 'order.color', 'order.size', 'order.status', 'order.price', 'order.quantity as cart_quantity', 'products.name', 'products.slug', 'products.product_img', 'order.quantity', DB::raw('order.quantity * order.price as total'))
                ->join('products', 'products.id', 'order.product_id')
                ->where('order.unique_order_id', $response['order_id'])
                ->get();
            if (count($orders)> 0) {
                foreach ($orders as $order) {
                    $cartProduct = Cart::where('product_id', $order->product_id)->first()->delete();
                    $order->status = $response['order_status'];
                    $order->save();
                }
                if ($response['order_status'] == 'Success') {
                    Session::flash('success', 'Your order successfully placed..!');
                } else {
                    Session::flash('error', $response['failure_message']);
                }

                foreach ($orders as $order){
                    $cartProduct = Cart::where('product_id', $order->product_id)->first();
                    if($cartProduct){
                        $cartProduct->delete();
                    }
                }

                $date = Order::select('created_at', 'user_id')->where('unique_order_id', $response['order_id'])->first();
                $user = User::find($date->user_id);
                if ($user) {
                    if ($response['merchant_param1'] != '') {
                        $user->wallet_amount = $user->wallet_amount - $response['merchant_param1'];
                        $user->save();
                    }

                    $total = Order::select(DB::raw('order.quantity * order.price as total'))
                        ->join('products', 'products.id', 'order.product_id')
                        ->where('order.unique_order_id', $response['order_id'])
                        ->first();

                    $data = array('username' => $user->username, 'total' => $total->total, 'products' => $orders, 'date' => $date->created_at);
                    $this->mailService->sendOrderMail($data, $user);
                }
                Session::flash('success', 'Order placed successfully..!');
                return redirect()->route('get:order_summary', $response['order_id']);
            }else{
                Session::flash('error', 'Something is wrong please try again..!');
                return redirect()->route('get:order_summary', $response['order_id']);
            }
        } else {
            if ($response['order_status'] == RechargeHistory::SUCCESS) {
                $recharge->payment_status = RechargeHistory::SUCCESS;
                $recharge->save();

                $myurl = "http://response.rcpanel.com/api_users/recharge?username=110298&pwd=3y691ai0&circlecode=12&operatorcode=" . $recharge->op_code . "&number=" . $recharge->recharge_num . "&amount=" . $recharge->amount . "&orderid=" . $recharge->transaction_id . "";
                $result = $this->rechargeManager->curl_get($myurl);
                $myArray = explode('#', $result);
                $recharge->res_trans_id = $myArray[0];
                $recharge->status = $myArray[1];
                $recharge->operator = $myArray[2];
                $recharge->save();

                if ($myArray[1] == 'Pending') {
                    $myurl1 = "http://response.rcpanel.com/api_users/status?username=110298&pwd=3y691ai0&orderid=" . $recharge->transaction_id . "&txnid=" . $recharge->res_trans_id . "";
                    $status = $this->rechargeManager->curl_get($myurl1);
                    $myArray = explode('#', $status);
                    $recharge->status = $myArray[0];
                    $recharge->operator = $myArray[1];
                    $recharge->save();
                }
                if ($recharge->status == 'Success') {
                    if($response['merchant_param1'] != ''){
                        $walletHistory = new WalletHistory();
                        $user = $this->rechargeManager->updateWalletHistory($walletHistory, $recharge);
                        $user->wallet_amount = $user->wallet_amount - $response['merchant_param1'];
                        $user->save();
                    }
                    Session::flash('success', 'Recharge successfully done..!');
                } elseif ($recharge->status == 'Failure') {
                    Session::flash('error', 'Recharge fail..!');
                } else {
                    Session::flash('success', 'Recharge pending..!');
                }
            } elseif ($response['order_status'] == RechargeHistory::PENDING) {
                $recharge->status = RechargeHistory::PENDING;
                $recharge->save();
                Session::flash('success', 'Recharge successfully completed..!');
            } else {
                $recharge->status = RechargeHistory::FAILED;
                $recharge->save();
                $walletHistory = new WalletHistory();
                $user = $this->rechargeManager->updateFailWalletHistory($walletHistory, $recharge, $response);
                $user->wallet_amount = $user->wallet_amount + $response['amount'];
                $user->save();
                Session::flash('error', $response['failure_message']);
            }
            $user = User::find($recharge->user_id);
            $operator = Operators::find($recharge->operator_id);
            $data = array('username' => $user->username, 'email' => $user->email, 'mobile_num' => $recharge->recharge_num, 'amount' => $recharge->amount, 'status' => $recharge->status, 'operator' => $operator->name);
            $this->mailService->sendRechargeMail($data, $user);
            return redirect()->route('get:order_page', $recharge->transaction_id);
        }
    }

    public function getDataCardRecharge()
    {
        $dataCard = Operators::select('operators.id', 'operators.name')
            ->join('services', 'services.id', 'operators.service_id')
            ->where('services.name', RechargeHistory::PREPAIDRECHARGE)
            ->where('operators.status', 1)
            ->get();
        $circles = Circle::select('id', 'name', 'code')->get();
        return view('front.pages.recharge.data_card_recharge', compact('dataCard', 'circles'));
    }

    public function postDataCardRecharge(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'datacard' => 'required',
            'operator' => 'required',
            'amount' => 'required|integer',
            'circle' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }

        $recharge = new RechargeHistory();
        $this->rechargeManager->saveRechargeDetails($recharge, $request->get('datacard'), $request->get('operator'), $request->get('circle'), $request->get('amount'));
        $service = Services::where('name', $request->get('type'))->first();
        if (!$service) {
            Session::flash('error', 'Service not found..!');
            return redirect()->back();
        }
        $recharge->service_id = $service->id;
        $recharge->save();
        return redirect()->route('get:order_page', $recharge->transaction_id);
    }

    public function getDthRecharge()
    {
        $dth = Operators::select('operators.id', 'operators.name')
            ->join('services', 'services.id', 'operators.service_id')
            ->where('services.name', RechargeHistory::DTHRECHARGE)
            ->where('operators.status', 1)
            ->get();
        $circles = Circle::select('id', 'name', 'code')->get();
        return view('front.pages.recharge.dth_recharge', compact('dth', 'circles'));
    }

    public function postDthRecharge(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subscriber_id' => 'required',
            'operator' => 'required',
            'amount' => 'required|integer',
            'circle' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }

        $recharge = new RechargeHistory();
        $this->rechargeManager->saveRechargeDetails($recharge, $request->get('subscriber_id'), $request->get('operator'), $request->get('circle'), $request->get('amount'));
        $service = Services::where('name', $request->get('type'))->first();
        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found..!'
            ]);
        }
        $recharge->service_id = $service->id;
        $recharge->save();

        return response()->json([
            'success' => true,
            'url' => route('get:order_page', $recharge->transaction_id)
        ]);
    }

    public function getBroadbandRecharge()
    {
        $broadband = Operators::select('operators.id', 'operators.name')
            ->join('services', 'services.id', 'operators.service_id')
            ->where('services.name', RechargeHistory::BROADBAND)
            ->where('operators.status', 1)
            ->get();
        $circles = Circle::select('id', 'name', 'code')->get();

        return view('front.pages.recharge.broadband_recharge', compact('broadband', 'circles'));
    }

    public function getWaterRecharge()
    {
        $water = Operators::select('operators.id', 'operators.name')
            ->join('services', 'services.id', 'operators.service_id')
            ->where('services.name', RechargeHistory::WATER)
            ->where('operators.status', 1)
            ->get();
        $circles = Circle::select('id', 'name', 'code')->get();
        return view('front.pages.recharge.water_recharge', compact('water', 'circles'));
    }

    public function postWaterRecharge(Request $request)
    {
        $recharge = new RechargeHistory();
        $this->rechargeManager->saveRechargeDetails($recharge, $request->get('k_num'), $request->get('operator'), $request->get('circle'), $request->get('amount'));
        $service = Services::where('name', $request->get('type'))->first();
        if (!$service) {
            Session::flash('error', 'Service not found..!');
            return redirect()->back();
        }
        $recharge->service_id = $service->id;
        $recharge->save();

        return redirect()->route('get:order_page', $recharge->transaction_id);
    }

    public function getLandLineRecharge()
    {
        $landline = Operators::select('operators.id', 'operators.name')
            ->join('services', 'services.id', 'operators.service_id')
            ->where('services.name', RechargeHistory::LANDLINE)
            ->where('operators.status', 1)
            ->get();
        $circles = Circle::select('id', 'name', 'code')->get();
        return view('front.pages.recharge.land_line_recharge', compact('landline', 'circles'));
    }

    public function postLandLineRecharge(Request $request)
    {
        $recharge = new RechargeHistory();
        $this->rechargeManager->saveRechargeDetails($recharge, $request->get('phone_num'), $request->get('operator'), $request->get('circle'), $request->get('amount'));
        $service = Services::where('name', $request->get('type'))->first();
        if (!$service) {
            Session::flash('error', 'Service not found..!');
            return redirect()->back();
        }
        $recharge->service_id = $service->id;
        $recharge->save();

        return redirect()->route('get:order_page', $recharge->transaction_id);
    }

    public function getElectricityRecharge()
    {
        $electricity = Operators::select('operators.id', 'operators.name')
            ->join('services', 'services.id', 'operators.service_id')
            ->where('services.name', RechargeHistory::ELECTRICITY)
            ->where('operators.status', 1)
            ->get();
        $circles = Circle::select('id', 'name', 'code')->get();
        return view('front.pages.recharge.electricity_recharge', compact('electricity', 'circles'));
    }

    public function postElectricityRecharge(Request $request)
    {
        $recharge = new RechargeHistory();
        $this->rechargeManager->saveRechargeDetails($recharge, $request->get('customer_num'), $request->get('operator'), $request->get('circle'), $request->get('amount'));
        $service = Services::where('name', $request->get('type'))->first();
        if (!$service) {
            Session::flash('error', 'Service not found..!');
            return redirect()->back();
        }
        $recharge->service_id = $service->id;
        $recharge->save();

        return redirect()->route('get:order_page', $recharge->transaction_id);
    }

    public function getGasRecharge()
    {
        $gas = Operators::select('operators.id', 'operators.name')
            ->join('services', 'services.id', 'operators.service_id')
            ->where('services.name', RechargeHistory::GAS)
            ->where('operators.status', 1)
            ->get();
        $circles = Circle::select('id', 'name', 'code')->get();
        return view('front.pages.recharge.gas_recharge', compact('gas', 'circles'));
    }

    public function postGasRecharge(Request $request)
    {
        $recharge = new RechargeHistory();
        $this->rechargeManager->saveRechargeDetails($recharge, $request->get('customer_id_num'), $request->get('provider'), $request->get('circle'), $request->get('amount'));
        $service = Services::where('name', $request->get('type'))->first();
        if (!$service) {
            Session::flash('error', 'Service not found..!');
            return redirect()->back();
        }
        $recharge->service_id = $service->id;
        $recharge->save();

        return redirect()->route('get:order_page', $recharge->transaction_id);
    }

    public function getRechargeCallback(Request $request)
    {
        $recharge = RechargeHistory::where('transaction_id', $request->get('txid'))->first();
        if (!$request) {
            return response()->json([
                'status' => 404,
                'message' => 'Data not found'

            ]);
        }
        $recharge->status = $request->get('status');
        $operator = Operators::where('op_code', $request->get('opid'))->limit(1)->first();
        if ($operator) {
            $recharge->operator_id = $operator->id;
        }
        $recharge->save();
    }

    public function getCancelRecharge($transId)
    {
        $recharge = RechargeHistory::where('transaction_id', $transId)->limit(1)->first();
        if (!$recharge) {
            Session::flash('error', 'Something is wrong please try again..!');
            return redirect()->back();
        }
        $recharge->delete();
        Session::flash('success', 'Recharge cancel successfully..!');
        return redirect()->route('get:homepage');
    }

    public function getRechargePlans(Request $request)
    {
        $operator = Operators::find($request->get('operator'));
        if (!$operator) {
            return response()->json([
                'error' => true,
                'message' => 'Operator not found..!'
            ]);
        }
        $circle = Circle::find($request->get('circle'));
        if (!$circle) {
            return response()->json([
                'error' => true,
                'message' => 'Circle not found..!'
            ]);
        }
        if ($operator->op_code1) {
            $myUrl = 'https://www.rcpanel.com/recharge-plan-api?opcode=' . trim($operator->op_code1) . '&zone=' . trim($circle->code) . '';
            $url = str_replace(' ', '%20', $myUrl);
            $json = $this->rechargeManager->geturl("$url");
            $result = json_decode($json, true);

            if ($result['status'][0] == 1) {
                $talktimes = $result['am'];
                $validity = $result['val'];
                $desc = $result['des'];
                $tp = $result['tp'];

                $twoGPlan = [];
                $threeGFourGPlan = [];
                $comboPlan = [];
                $smsPlan = [];
                $roamingPlan = [];
                $talktimePlan = [];
                $stvPlan = [];
                foreach ($tp as $key => $item) {
                    if ($item == "2g data") {
                        $tt = $talktimes[$key];
                        $description = $desc[$key];
                        $val = $validity[$key];
                        $twoGPlan[] = [$tt, $description, $val];
                    }
                    if ($item == "3g/4g data") {
                        $threeGFourGPlan[] = [$talktimes[$key], $desc[$key], $validity[$key]];
                    }
                    if ($item == "combo") {
                        $comboPlan[] = [$talktimes[$key], $desc[$key], $validity[$key]];
                    }
                    if ($item == "sms") {
                        $smsPlan[] = [$talktimes[$key], $desc[$key], $validity[$key]];
                    }
                    if ($item == "roaming") {
                        $roamingPlan[] = [$talktimes[$key], $desc[$key], $validity[$key]];
                    }
                    if ($item == "talktime") {
                        $talktimePlan[] = [$talktimes[$key], $desc[$key], $validity[$key]];
                    }
                    if ($item == "stv") {
                        $stvPlan[] = [$talktimes[$key], $desc[$key], $validity[$key]];
                    }
                }
                return view('front.pages.recharge.plans', compact('twoGPlan', 'threeGFourGPlan', 'comboPlan', 'smsPlan', 'roamingPlan', 'talktimePlan', 'stvPlan'));
            }
        } else {
            return response()->json([
                'error' => true,
            ]);
        }
    }
}
