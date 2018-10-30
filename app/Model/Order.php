<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    const CREDITCARD = 'credit_card';
    const DEBITCARD = 'debit_card';
    const CASHONDELIVERY = 'cod';

    //Old
    // const SUCCESS = 'Success';
    // const FAILED = 'Failure';

    //New by ishwar
    const SUCCESS = 'success';
    const FAILED = 'failed';

    const Aborted = 'Aborted';
    const Invalid = 'Invalid';
    const PENDING = 'pending';
    const CANCELED = 'canceled';
    const RETURNED = 'returned';
    const PROCESS = 'process';

    // const DISPATCH = 'dispatch';

    const DISPATCH = 'dispute';
    const ONTHEWAY = 'ontheway';
    const NEARBYYOU = 'nearbyyou';
    const DELIVERED = 'delivered';

    protected $table = 'order';

    public function AuthTotalPrice()
    {
        $total = DB::table('order')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->where('order.user_id', Auth::user()->id)
            ->sum(DB::raw('products.price * order.quantity'));
        if ($total) {
            return $total;
        }
    }

    public function number_format_short($n, $precision = 1)
    {
        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 900000) {
            // 0.9k-850k
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'K';
        } else if ($n < 900000000) {
            // 0.9m-850m
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'M';
        } else if ($n < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }
        // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
        // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ($precision > 0) {
            $dotzero = '.' . str_repeat('0', $precision);
            $n_format = str_replace($dotzero, '', $n_format);
        }
        return $n_format . $suffix;
    }

    public function getSell($month)
    {
        $sell = Order::select(DB::raw('sum(price) as newPrice'))->whereRaw('MONTH(created_at) = ?', [$month])->first();
        if (count($sell->newPrice) > 0) {
            return  $sell->newPrice;
        } else {
            return 0;
        }
    }

    public function itemSoldByMonth($month)
    {
        $orders = Order::whereRaw('MONTH(created_at) = ?', [$month])->where('status', '!=', 'Failed')->count();
        if(count($orders)>0){
            return $orders;
        }else{
            return 0;
        }
    }

    public function getTotalProfitByMonth($month)
    {
        $flatCommission = Order::select('subcategories.*')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('subcategories.commission_type', SubCategory::FLAT)
            ->whereRaw('MONTH(order.created_at) = ?', [$month])
            ->sum('subcategories.commission');

        $percentageCommission = Order::select(DB::raw('sum(subcategories.commission * .01 * order.price) as newPrice'))
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('subcategories.commission_type', SubCategory::PERCENTAGE)
            ->first();
        $commision = $flatCommission + $percentageCommission->newPrice;
        $sell = Order::select(DB::raw('sum(price) as newPrice'))->whereRaw('MONTH(created_at) = ?', [$month])->first();
        if(count($sell->newPrice) > 0 && $commision){
            return $this->number_format_short($sell->newPrice - $commision);
        }else{
            return 0;
        }
    }

    public function getCommissionByOrderId()
    {
        $flatCommission = Order::select('subcategories.*')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('subcategories.commission_type', SubCategory::FLAT)
            ->where('order.unique_order_id', $this->unique_order_id)
            ->sum('subcategories.commission');

        $percentageCommission = Order::select(DB::raw('sum(subcategories.commission * .01 * order.price) as newPrice'))
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('subcategories.commission_type', SubCategory::PERCENTAGE)
            ->where('order.unique_order_id', $this->unique_order_id)
            ->first();

        $commission = $flatCommission + $percentageCommission->newPrice;

        if(count($commission) > 0){
            return $this->number_format_short($commission);
        }else{
            return 0;
        }
    }

    public function getCommissionByTransactionId()
    {
        $flatCommission = Order::select('subcategories.*')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('subcategories.commission_type', SubCategory::FLAT)
            ->where('order.transaction_id', $this->transaction_id)
            ->sum('subcategories.commission');

        $percentageCommission = Order::select(DB::raw('sum(subcategories.commission * .01 * order.price) as newPrice'))
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('subcategories.commission_type', SubCategory::PERCENTAGE)
            ->where('order.transaction_id', $this->transaction_id)
            ->first();

        $commission = $flatCommission + $percentageCommission->newPrice;

        if (count($commission) > 0) {
            return $this->number_format_short($commission);
        } else {
            return 0;
        }
    }

    public function isAdmin()
    {
        $uid =  $this->id;
        $role= DB::table('role_user')
            ->where('role_user.user_id','=',$uid)
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->select('roles.name')
            ->first();
        if($role->name == 'admin'){
            return false;
        }else{
            return true;
        }
    }

    public function getTotalCommissionByMonth($month)
    {
        $flatCommission = Order::select('subcategories.*')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('subcategories.commission_type', SubCategory::FLAT)
            ->whereRaw('MONTH(order.created_at) = ?', [$month])
            ->sum('subcategories.commission');

        $percentageCommission = Order::select(DB::raw('sum(subcategories.commission * .01 * order.price) as newPrice'))
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('subcategories.commission_type', SubCategory::PERCENTAGE)
            ->whereRaw('MONTH(order.created_at) = ?', [$month])
            ->first();
        $commision = $flatCommission + $percentageCommission->newPrice;
        $sell = Order::select(DB::raw('sum(price) as newPrice'))->whereRaw('MONTH(created_at) = ?', [$month])->first();
        if(count($sell->newPrice) > 0 && $commision){
            return $this->number_format_short($commision);
        }else{
            return 0;
        }
    }

    public function percentageOf($number, $everything, $decimals = 2)
    {
        if($everything != 0){
            return round($number / $everything * 100, $decimals);
        }
    }

    public function getDispatchDate($order)
    {
        $date = ShippingHistory::select('delivery_date')->where('order_id', $this->id)->where('status', $order)->limit(1)->first();
        if($date){
            return  \Carbon\Carbon::parse($date->delivery_date)->format("D, dS M H:I A");
        }else{
            return null;
        }
    }
}
