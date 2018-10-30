<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    protected $table = 'cart';

    public function AuthTotalPrice()
    {
        $total = DB::table('cart')
            ->join('products', 'products.id', '=', 'cart.product_id')
            ->where('cart.user_id', Auth::user()->id)
            ->sum(DB::raw('cart.price * cart.quantity'));
        if($total){
            return $total;
        }
    }


    public function getTotal()
    {
        $total = DB::table('cart')
            ->join('products', 'products.id', '=', 'cart.product_id')
            ->where('cart.cart_temp_id', Session::get('cart_temp_id'))
            ->sum(DB::raw('cart.price * cart.quantity'));
        if($total){
            return $total;
        }
    }
}
