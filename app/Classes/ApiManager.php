<?php
/**
 * Created by PhpStorm.
 * User: xyz
 * Date: 4/3/2018
 * Time: 10:25 AM
 */

namespace App\Classes;


use App\Model\Products;
use App\Model\Services;
use App\Model\SubCategory;
use Illuminate\Support\Facades\DB;

class ApiManager
{
    public function getLimitProducts($limit)
    {
        $discountProducts = Products::select(DB::raw("products.id , products.name, products.product_img, products.price , product_discount.price as discount"))
            ->leftJoin('product_discount', 'products.id', '=', 'product_discount.product_id')
            ->where(function ($query) {
                $query->where('product_discount.start_date', '<=', date('Y-m-d'))
                    ->where('product_discount.end_date', '>=', date('Y-m-d'));
            })
            ->orderBy("products.created_at", 'DESC')
            ->limit($limit)
            ->where('products.status', 1)
            ->get();
        return $discountProducts;
    }

    public function getProducts()
    {
        $discountProducts = Products::select(DB::raw("products.id , products.name, products.product_img, products.price , product_discount.price as discount"))
            ->leftJoin('product_discount', 'products.id', '=', 'product_discount.product_id')
            ->where(function ($query) {
                $query->where('product_discount.start_date', '<=', date('Y-m-d'))
                    ->where('product_discount.end_date', '>=', date('Y-m-d'));
            })
            ->orderBy("products.created_at", 'DESC')
            ->where('products.status', 1)
            ->get();
        return $discountProducts;
    }

    public function sendOtp($user)
    {
        $user->otp = rand(100000, 999999);
        $user->save();

        $message = 'Your OTP is '.$user->otp.'  from LozyPay';
        $url = 'http://control.pay4sms.com/api/sendhttp.php?authkey=206192A1HDlUiTut5aba1335&mobiles=' . $user->mobile_num . '&message='.$message. '&sender=lzypay&route=4&country=91';
        $ch = curl_init();
        $timeout = 300; // set to zero for no timeout
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function getSubcategoryProducts($subcategoryId)
    {
        $subcategoryProducts = Products::select(DB::raw("products.id , products.name, products.product_img, products.price , product_discount.price as discount"))
            ->leftJoin('product_discount', 'products.id', '=', 'product_discount.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            // ->orwhere(function ($query) {
            //     $query->where('product_discount.start_date', '<=', date('Y-m-d'))
            //         ->where('product_discount.end_date', '>=', date('Y-m-d'));
            // })
            ->orderBy("products.created_at", 'DESC')
            ->where('products.status', 1)
            ->where('subcategories.id', $subcategoryId)
            ->get();
        return $subcategoryProducts;
    }

    public function getProductById($productId)
    {
        $product = Products::select('products.id', 'products.name', 'products.product_img', 'products.size_chart', 'products.price', 'products.slug', 'products.quantity', 'products.desc', 'products.video_id', 'products.video_thumb', 'subcategories.id as subId', 'subcategories.name as subCatName', 'categories.name as CatName', 'users.username')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->where('products.id', $productId)
            ->limit(1)
            ->first();
        return $product;
    }

    public function saveRechargeHistory($recharge, $userId, $request)
    {
        $recharge->user_id = $userId;
        $recharge->recharge_num = $request->get('recharge_num');
        $recharge->operator_id = $request->get('operator');
        if ($request->get('circle')) {
            $recharge->circle = $request->get('circle');
        }
        $recharge->amount = $request->get('amount');
        $uniqueId = uniqid();
        $recharge->transaction_id = $uniqueId;
        return $recharge;
    }
}