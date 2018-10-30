<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('register', ['as' => 'get:register', 'uses' => 'ApiController@register']);
Route::post('login', ['as' => 'get:login', 'uses' => 'ApiController@login']);
Route::post('verify-otp', ['as' => 'get:verify_otp', 'uses' => 'ApiController@getVerifyOtp']);
Route::post('resend-otp', ['as' => 'get:resend_otp', 'uses' => 'ApiController@getResendOtp']);
Route::post('change-password', ['as' => 'post:change_password', 'uses' => 'ApiController@getChangePassword']);
Route::post('verify-password', ['as' => 'post:verify_password', 'uses' => 'ApiController@postVerifyPassword']);

Route::get('products', ['as' => 'get:products', 'uses' => 'ApiController@getProducts']);
Route::get('product-details', ['as' => 'get:product_details', 'uses' => 'ApiController@getProductDetails']);
Route::post('post-review', ['as' => 'post:review', 'uses' => 'ApiController@postReview']);
Route::get('categories', ['as' => 'get:categories', 'uses' => 'ApiController@getCategories']);
Route::get('subcategories', ['as' => 'get:subcategories', 'uses' => 'ApiController@getSubcategories']);
Route::get('subcategory-products', ['as' => 'get:subcategory_products', 'uses' => 'ApiController@getSubcategoryProducts']);
Route::get('new-arrivals-products', ['as' => 'get:new_arrivals_products', 'uses' => 'ApiController@getNewArrivalsProducts']);
Route::get('top-seller-products', ['as' => 'get:top_seller_products', 'uses' => 'ApiController@getTopSellerProducts']);
Route::get('special-products', ['as' => 'get:special_products', 'uses' => 'ApiController@getSpecialProducts']);
Route::get('recommend-products', ['as' => 'get:recommend_products', 'uses' => 'ApiController@getRecommendProducts']);
Route::get('upTo40Discounts-products', ['as' => 'get:upTo40Discounts_products', 'uses' => 'ApiController@getUpTo40DiscountsProducts']);
Route::get('upTo50Discounts-products', ['as' => 'get:upTo50Discounts_products', 'uses' => 'ApiController@getUpTo50DiscountsProducts']);
Route::get('upTo60Discounts-products', ['as' => 'get:upTo60Discounts_products', 'uses' => 'ApiController@getUpTo60DiscountsProducts']);
Route::get('upTo70Discounts-products', ['as' => 'get:upTo70Discounts_products', 'uses' => 'ApiController@getUpTo70DiscountsProducts']);
Route::get('upTo80Discounts-products', ['as' => 'get:upTo80Discounts_products', 'uses' => 'ApiController@getUpTo80DiscountsProducts']);
Route::get('homepage-sliders', ['as' => 'get:homepage_sliders', 'uses' => 'ApiController@getHomepageSliders']);
Route::get('main-sliders', ['as' => 'get:main_sliders', 'uses' => 'ApiController@getMainSliders']);

Route::get('states', ['as' => 'get:states', 'uses' => 'ApiController@getStates']);
Route::get('cities', ['as' => 'get:cities', 'uses' => 'ApiController@getCities']);
Route::post('update-profile', ['as' => 'post:update_profile', 'uses' => 'ApiController@postUpdateProfile']);
Route::post('add-address', ['as' => 'post:add_address', 'uses' => 'ApiController@postAddAddress']);
Route::get('address', ['as' => 'get:address', 'uses' => 'ApiController@getAddress']);
Route::get('delete-address', ['as' => 'get:delete_address', 'uses' => 'ApiController@getDeleteAddress']);
Route::post('product-wishlist', ['as' => 'post:product_wishlist', 'uses' => 'ApiController@postProductWishlist']);
Route::get('wishlist-products', ['as' => 'get:wishlist_products', 'uses' => 'ApiController@getWishlistProducts']);
Route::post('add-to-cart', ['as' => 'post:add_to_cart', 'uses' => 'ApiController@postAddToCart']);
Route::get('cart-products', ['as' => 'get:cart_products', 'uses' => 'ApiController@getCartProducts']);
Route::post('cart-quantity-update', ['as' => 'get:cart_quantity_update', 'uses' => 'ApiController@getCartQuantityUpdate']);
Route::get('cart-item-delete', ['as' => 'get:cart_item_delete', 'uses' => 'ApiController@getCartItemDelete']);
Route::post('checkout', ['as' => 'post:checkout', 'uses' => 'ApiController@postCheckout']);

Route::post('single-product-checkout', ['as' => 'post:single_product_checkout', 'uses' => 'ApiController@postSingleProductCheckout']);

//order history
Route::get('recharge-history', ['as' => 'get:recharge_history', 'uses' => 'ApiController@getRechargeHistory']);
Route::get('product-history', ['as' => 'get:product_history', 'uses' => 'ApiController@getProductHistory']);
Route::get('wallet-history', ['as' => 'get:wallet_history', 'uses' => 'ApiController@getWalletHistory']);
Route::get('order-shipping-process', ['as' => 'post:order_shipping_process', 'uses' => 'ApiController@postOrderShippingProcess']);
//user details
Route::get('user-details', ['as' => 'get:user_details', 'uses' => 'ApiController@getUserDetails']);

//operators
Route::get('prepaid-operator', ['as' => 'get:prepaid_operator', 'uses' => 'ApiController@getPrepaidOperator']);
Route::get('datacard-operator', ['as' => 'get:datacard-operator', 'uses' => 'ApiController@getDatacardOperator']);
Route::get('postpaid-operator', ['as' => 'get:postpaid_operator', 'uses' => 'ApiController@getPostpaidOperator']);
Route::get('dth-operator', ['as' => 'get:dth_operator', 'uses' => 'ApiController@getDthOperator']);

//recharge routes
Route::post('prepaid-recharge', ['as' => 'get:prepaid_recharge', 'uses' => 'ApiController@getPrepaidRecharge']);
Route::post('dth-recharge', ['as' => 'post:dth_recharge', 'uses' => 'ApiController@postDthRecharge']);

//other page
Route::get('about-us', ['as' => 'get:about_us', 'uses' => 'ApiController@getAboutUs']);
Route::get('terms-conditions', ['as' => 'get:terms_conditions', 'uses' => 'ApiController@getTermsConditions']);
Route::get('delivery-info', ['as' => 'get:delivery_info', 'uses' => 'ApiController@getDeliveryInfo']);
Route::get('cancellation-returns', ['as' => 'get:cancellation_returns', 'uses' => 'ApiController@getCancellationReturns']);
Route::get('seller-policy', ['as' => 'get:seller_policy', 'uses' => 'ApiController@getSellerPolicy']);
Route::get('faq', ['as' => 'get:faq', 'uses' => 'ApiController@getFAQ']);
Route::get('testimonials', ['as' => 'get:testimonials', 'uses' => 'ApiController@getTestimonials']);
Route::post('contact-us', ['as' => 'post:contact_us', 'uses' => 'ApiController@postContactUs']);

Route::get('add-money-wallet', ['as' => 'get:add_money_wallet', 'uses' => 'ApiController@getAddMoneyWallet']);

//filter routes
Route::get('filter', ['as' => 'get:filter', 'uses' => 'ApiController@getFilter']);
Route::post('filter-apply', ['as' => 'post:filter_apply', 'uses' => 'ApiController@postFilterApply']);
Route::post('price-filter', ['as' => 'post:price_filter', 'uses' => 'ApiController@postPriceFilter']);
