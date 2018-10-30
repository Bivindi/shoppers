<?php

namespace App\Http\Controllers;


use App\Classes\MailService;
use App\Classes\UserManager;
use App\Classes\WalletManager;
use App\Model\User;
use App\Model\WalletHistory;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Softon\Indipay\Facades\Indipay;

class WalletController extends Controller
{
    /**
     * @var WalletManager
     */
    private $walletManager;

    protected $user;
    /**
     * @var UserManager
     */
    private $userManager;
    /**
     * @var MailService
     */
    private $mailService;

    public function __construct(WalletManager $walletManager, UserManager $userManager, MailService $mailService)
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            if (auth()->user() && auth()->user()->hasRole('admin') || auth()->user() && auth()->user()->hasRole('seller')) {
                Auth::logout();
                return redirect('/');
            }
            return $next($request);
        });
        $this->walletManager = $walletManager;
        $this->userManager = $userManager;
        $this->mailService = $mailService;
    }

    public function getWallet()
    {
        return view('front.pages.wallet.wallet');
    }

    public function getAddMoneyWallet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => "required|regex:/^\d*(\.\d{1,2})?$/",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        DB::beginTransaction();
        try {
            $amount = $request->get('amount');

            $walletHistory = new WalletHistory();
            $user = Auth::user();
            $uniqueId = $this->userManager->randomKey();
            $walletHistory = $this->walletManager->saveWalletMoney($walletHistory, $user, $amount, $uniqueId);
            $walletHistory->save();

            $parameters = [
                'merchant_id' => env('INDIPAY_MERCHANT_ID'),
                'currency' => 'INR',
                'redirect_url' => env('APP_URL') . 'wallet/response',
                'cancel_url' => env('APP_URL') . 'wallet/response',
                'language' => 'EN',
                'order_id' => $uniqueId,
                'tid' => $uniqueId,
                'email' => $user->email,
                'phone' => $user->mobile_num,
                'amount' => "$amount",
            ];
            $order = Indipay::gateway('CCAvenue')->prepare($parameters);
            DB::commit();
            return Indipay::process($order);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e);
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong !'
            ]);
        }
    }

    public function getWalletResponse(Request $request)
    {
        $response = Indipay::gateway('CCAvenue')->response($request);
        $wallet = WalletHistory::where('transaction_id', $response['order_id'])
            ->limit(1)->first();
        $user = User::find($wallet->user_id);
        if (!$wallet && $response['order_status'] != WalletHistory::SUCCESS) {
            $wallet->status = WalletHistory::FAILED;
            $wallet->save();
            $data = array('username' => $user->username, 'total' => $user->wallet_amount, 'wallet' => $response['amount']);
            $this->mailService->sendNotAddWalletMail($data, $user);
            if($response['merchant_param2'] == 'app'){
                $status = $wallet->status;
                return view('front.pages.wallet.wallet_status', compact('status'));
            }
            Session::flash('error', 'Wallet amount not added try again..!');
            return redirect()->route('get:wallet')->with('status', $wallet->status);
        }
        $user->wallet_amount = $user->wallet_amount + $response['amount'];
        $user->save();
        $wallet->status = WalletHistory::SUCCESS;
        $wallet->save();
        $data = array('username' => $user->username, 'total' => $user->wallet_amount, 'wallet' => $response['amount']);
        $this->mailService->sendAddWalletMail($data, $user);
        if($response['merchant_param2'] == 'app'){
            $status = $wallet->status;
            return view('front.pages.wallet.wallet_status', compact('status'));
        }
        Session::flash('success', 'Wallet amount added successfully..!');
        return redirect()->route('get:wallet')->with('status', $wallet->status);
    }

    public function getWalletToWalletForm()
    {
        return view('front.pages.wallet.wallet_to_wallet');
    }

    public function postWalletToWalletMoney(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'money' => 'required',
            'mobile_num' => 'required|regex:/[0-9]{10}/|digits:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors(),
            ]);
        }

        $receiverUser = User::where('mobile_num', $request->get('mobile_num'))->limit(1)->first();
        if (!$receiverUser) {
            return response()->json([
                'success' => false,
                'message' => 'You enter mobile number is not found in our database..!'
            ]);
        }
        $senderUser = Auth::user();
        if ($senderUser->wallet_amount < $request->get('amount')) {
            return response()->json([
                'success' => false,
                'message' => 'Your wallet money is less then you transfer money..!'
            ]);
        }

        $receiverWallet = new WalletHistory();
        $this->walletManager->saveReceiverMoney($receiverWallet, $senderUser, $receiverUser, $request);

        $senderWallet = new WalletHistory();
        $this->walletManager->saveSenderMoney($senderWallet, $receiverUser, $request);

        $user = Auth::user();
        $user->wallet_amount = Auth::user()->wallet_amount - $request->get('money');
        $user->save();

        $receiverUser->wallet_amount = $receiverUser->wallet_amount + $request->get('money');
        $receiverUser->save();

        Session::flash('success', 'Your transaction is complete..!');
        return response()->json([
            'success' => true,
            'message' => 'Your transaction is complete..!'
        ]);
    }
}
