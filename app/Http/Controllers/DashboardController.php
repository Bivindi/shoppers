<?php

namespace App\Http\Controllers;

use App\Classes\DashboardManager;
use App\Http\Requests\ProfileRequest;
use App\Model\KycDocuments;
use App\Model\Order;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    /**
     * @var DashboardManager
     */
    private $dashboardManager;

    public function __construct(DashboardManager $dashboardManager)
    {
        $this->dashboardManager = $dashboardManager;
    }

    public function getDashboard()
    {
        
        $totalOrders = Order::join('products', 'products.id', '=', 'order.product_id')
            ->where('products.user_id', Auth::user()->id)
            ->count();
        $todayOrders = Order::join('products', 'products.id', '=', 'order.product_id')
            ->where('products.user_id', Auth::user()->id)
            ->whereDate('order.created_at', DB::raw('CURDATE()'))
            ->count();
        $successOrder = Order::join('products', 'products.id', '=', 'order.product_id')
            ->where('products.user_id', Auth::user()->id)
            ->where('order.status', 'Success')
            ->count();
        $pendingOrder = Order::join('products', 'products.id', '=', 'order.product_id')
            ->where('products.user_id', Auth::user()->id)
            ->where('order.status', 'Pending')
            ->count();
        $totalSale = Order::select(DB::raw('sum(order.price) as newPrice'))
            ->join('products', 'products.id', '=', 'order.product_id')
            ->where('products.user_id', Auth::user()->id)
            ->get();
        $todaySale = Order::select(DB::raw('sum(order.price) as newPrice'))
            ->join('products', 'products.id', '=', 'order.product_id')
            ->where('products.user_id', Auth::user()->id)
            ->whereDate('order.created_at', DB::raw('CURDATE()'))->first();

        $pendingAmount = Order::select(DB::raw('sum(order.price) as newPrice'))
            ->join('products', 'products.id', '=', 'order.product_id')
            ->where('products.user_id', Auth::user()->id)
            ->where('order.status', 'Pending')->get();

        $flatCommission = $this->dashboardManager->getFlatCommission();
        $percentageCommission = $this->dashboardManager->getPercentageCommission();
        $commision = $flatCommission + $percentageCommission->newPrice;
        $totalCommision = $percentageCommission->number_format_short($commision);

        $totalCustomers = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'customer');
        })->count();

        $todayCustomers = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'customer');
        })->whereDate('users.created_at', DB::raw('CURDATE()'))
            ->count();

        $weekCustomers = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'customer');
        })->whereBetween('users.created_at', [
            Carbon::parse('last monday')->startOfDay(),
            Carbon::parse('next friday')->endOfDay(),
        ])->count();
        $monthCustomers = User::whereRaw('MONTH(created_at) = ?', [date('m')])->count();

        $latestOrder = Order::select('order.id', 'order.status', 'order.created_at', 'order.price', 'users.username')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->where('products.user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')->take(5)->get();
        
        return view('admin.pages.dashboard', compact('successOrder', 'latestOrder', 'pendingAmount', 'pendingOrder', 'totalOrders', 'todayOrders', 'totalSale', 'todaySale', 'totalCommision', 'totalCustomers', 'todayCustomers', 'weekCustomers', 'monthCustomers'));
    }

    public function getProfile()
    {
        $kycDocs = KycDocuments::select('id', 'kyc_doc')->where('kyc_doc', '!=', NULL)->get();
        $otherDocs = KycDocuments::select('id', 'other_doc')->where('other_doc', '!=', NULL)->get();
        return view('admin.pages.profile', compact('kycDocs', 'otherDocs'));
    }

    public function postProfile(ProfileRequest $request)
    {
        $this->dashboardManager->saveProfile($request);
        Session::flash('success', 'Profile updated successfully..!');
        return redirect()->back();
    }

    public function getDeleteKycDoc(Request $request)
    {
        $kycDoc = KycDocuments::where('kyc_doc', $request->get('kycDoc'))->limit(1)->first();
        if(!$kycDoc){
            return response()->json([
                'success' => false,
                'message' => 'Doc not found'
            ]);
        }
        $kycDoc->delete();
        return response()->json([
            'success' => true,
            'message' => 'Document delete successfully'
        ]);
    }

    public function getDeleteOtherDoc(Request $request)
    {
        $kycDoc = KycDocuments::where('other_doc', $request->get('kycDoc'))->limit(1)->first();
        if(!$kycDoc){
            return response()->json([
                'success' => false,
                'message' => 'Doc not found'
            ]);
        }
        $kycDoc->delete();
        return response()->json([
            'success' => true,
            'message' => 'Document delete successfully'
        ]);
    }
}
