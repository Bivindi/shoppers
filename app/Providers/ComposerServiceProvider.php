<?php

namespace App\Providers;

use App\Model\Cart;
use App\Model\Categories;
use App\Model\HomepageSlider;
use App\Model\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['*'], function ($view) {
            $categories = Categories::select('id', 'name', 'slug', 'cat_img', 'other_image', 'sidebar_image')->orderBy('name')->get();
            $topCategories = Categories::select('id', 'name', 'slug', 'cat_img', 'other_image', 'sidebar_image')->where('top_menu', 1)->get();
            $footerImage = HomepageSlider::select('id', 'footer_slider')->where('footer_slider', '!=', NULL)->first();
            if (Auth::check()) {
                $cartCount = Cart::where('user_id', Auth::user()->id)->count();

                $cartDetails = Products::select('products.id', 'products.name', 'products.product_img', 'cart.price', 'products.slug', 'cart.quantity')
                    ->join('cart', 'cart.product_id', '=', 'products.id')
                    ->where('cart.user_id', Auth::user()->id)
                    ->orderBy('cart.created_at', 'DESC')
                    ->get();

                $total = DB::table('cart')
                    ->join('products', 'products.id', '=', 'cart.product_id')
                    ->where('cart.user_id', Auth::user()->id)
                    ->sum(DB::raw('cart.price * cart.quantity'));

                $productTotal = Cart::select(DB::raw("SUM(products.price) as total_price"))
                    ->join('products', 'products.id', '=', 'cart.product_id')
                    ->where('cart.user_id', Auth::user()->id)
                    ->first();

                $view->with([
                    'cartCount' => $cartCount,
                    'cartDetails' => $cartDetails,
                    'totalPrice' => $total,
                    'productTotalPrice' => $productTotal,
                    'categories' => $categories,
                    'topCategories' => $topCategories,
                    'footerImage' => $footerImage,
                ]);
            } elseif (Session::has('cart_temp_id')) {
                $cartCount = Cart::where('cart_temp_id', Session::get('cart_temp_id'))->count();

                $cartDetails = Products::select('products.id', 'products.name', 'products.product_img', 'products.price', 'products.slug', 'cart.quantity')
                    ->join('cart', 'cart.product_id', '=', 'products.id')
                    ->where('cart.cart_temp_id', Session::get('cart_temp_id'))
                    ->orderBy('cart.created_at', 'DESC')
                    ->get();

                $total = DB::table('cart')
                    ->leftJoin('products', 'products.id', '=', 'cart.product_id')
                    ->where('cart.cart_temp_id', Session::get('cart_temp_id'))
                    ->sum(DB::raw('products.price * cart.quantity'));
                $view->with([
                    'cartCount' => $cartCount, //Share all categories for header dropdown
                    'cartDetails' => $cartDetails, //Get 12 on sale products
                    'totalPrice' => $total, //Get 12 on sale products
                    'categories' => $categories, //Get 12 on sale products
                    'topCategories' => $topCategories, //Get 12 on sale products
                    'footerImage' => $footerImage, //Get 12 on sale products
                ]);
            } else {
                $view->with([
                    'categories' => $categories,
                    'topCategories' => $topCategories,
                    'footerImage' => $footerImage,
                ]);
            }
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
