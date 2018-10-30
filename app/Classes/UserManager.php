<?php
/**
 * Created by PhpStorm.
 * User: xyz
 * Date: 2/22/2018
 * Time: 4:11 PM
 */

namespace App\Classes;


use App\Model\Brands;
use App\Model\Cart;
use App\Model\Compare;
use App\Model\KycDocuments;
use App\Model\Order;
use App\Model\ProductReview;
use App\Model\Products;
use App\Model\RechargeHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserManager
{
    public function userRegister($user, $request)
    {
        DB::beginTransaction();
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        if (isset($user->username)) {
            if ($user->username != $request->get('username')) {
                $user->slug = $user->getSlugForCustom($user->username);
            }
        } else {
            $user->slug = $user->getSlugForCustom($request->get('username'));
        }
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        if ($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }
        $user->mobile_num = $request->get('mobile_num');
        if ($request->get('pan_tan_number')) {
            $user->pan_or_tan_num = $request->get('pan_tan_number');
        }
        if ($request->get('gst_number')) {
            $user->gst_num = $request->get('gst_number');
        }
        if ($request->get('aadhar_num')) {
            $user->aadhar_num = $request->get('aadhar_num');
        }

        $user->categories_id = $request->get('categories_id');

        $user->save();
        if ($request->hasFile('kyc_docs')) {
            foreach ($request->file('kyc_docs') as $kycDoc){
                $photo = $kycDoc;
                $imagename = time() . uniqid(rand()) . '.' . $photo->getClientOriginalExtension();
                $destinationPath = public_path('/aadharcard');
                $photo->move($destinationPath, $imagename);
                $kyc = new KycDocuments();
                $kyc->user_id = $user->id;
                $kyc->kyc_doc = $imagename;
                $kyc->save();
            }
        }
        if ($request->hasFile('other_docs')) {
            foreach ($request->file('other_docs') as $otherDoc)
            $back = $otherDoc;
            $backimagename = time() . uniqid(rand()) . '.' . $back->getClientOriginalExtension();
            $destinationPath = public_path('/aadharcard');
            $back->move($destinationPath, $backimagename);
            $kyc = new KycDocuments();
            $kyc->user_id = $user->id;
            $kyc->other_doc = $backimagename;
            $kyc->save();
        }
        DB::commit();
        return $user;
    }

    public function getAuthUserCartDetails()
    {
        $cartDetails = Cart::select('products.id', 'products.name', 'products.product_img', 'cart.price', 'products.slug', 'products.quantity', 'products.sku', 'cart.quantity as cart_quantity', 'cart.id as cartId', 'cart.color as productColor', 'cart.size as productSize', 'users.username')
            ->join('products', 'products.id', '=', 'cart.product_id')
            ->join('users', 'users.id', '=', 'cart.user_id')
            ->where('cart.user_id', Auth::user()->id)
            ->orderBy('cart.created_at', 'DESC')
            ->get();
        return $cartDetails;
    }

    public function getAuthUserTotalPrice()
    {
        $totalPrice = Cart::select(DB::raw("SUM(products.price) as total_price"))
            ->join('products', 'products.id', '=', 'cart.product_id')
            ->where('cart.user_id', Auth::user()->id)
            ->first();
        return $totalPrice;
    }

    public function getUserCartDetails()
    {
        if (Session::has('cart_temp_id')) {
            $cartDetails = Cart::select('products.id', 'products.name', 'products.product_img', 'cart.price', 'products.slug', 'products.quantity', 'products.sku', 'cart.quantity as cart_quantity', 'cart.id as cartId')
                ->join('products', 'products.id', '=', 'cart.product_id')
                ->where('cart.cart_temp_id', Session::get('cart_temp_id'))
                ->orderBy('cart.created_at', 'DESC')
                ->get();
            return $cartDetails;
        }
    }

    public function getUserTotalPrice()
    {
        $totalPrice = Cart::select(DB::raw("SUM(products.price) as total_price"))
            ->join('products', 'products.id', '=', 'cart.product_id')
            ->where('cart.cart_temp_id', Session::get('cart_temp_id'))
            ->first();
        return $totalPrice;
    }

    public function saveAuthenticateCartProducts()
    {
        $cartItems = Cart::where('cart_temp_id', Session::get('cart_temp_id'))->get();
        $this->saveCartItems($cartItems);
        return $cartItems;
    }

    public function saveCartItems($cartItems)
    {
        foreach ($cartItems as $cartItem) {
            $cartItem->user_id = Auth::user()->id;
            $cartItem->cart_temp_id = '';
            $cartItem->save();
        }
        return $cartItems;
    }

    public function saveAuthenticateCompareProducts()
    {
        $compareProducts = Compare::where('compare_temp_id', Session::get('compare_temp_id'))->get();
        $this->saveCompareProducts($compareProducts);
        return $compareProducts;
    }

    public function saveAuthenticateRechargeOrder()
    {
        $rechargeOrder = RechargeHistory::where('recharge_temp_id', Session::get('recharge_temp_id'))->get();
        foreach ($rechargeOrder as $recharge) {
            $recharge->user_id = Auth::user()->id;
            $recharge->recharge_temp_id = '';
            $recharge->save();
        }
        return $rechargeOrder;
    }

    public function saveCompareProducts($compareProducts)
    {
        foreach ($compareProducts as $compareProduct) {
            $compareProduct->user_id = Auth::user()->id;
            $compareProduct->compare_temp_id = '';
            $compareProduct->save();
        }
        return $compareProduct;
    }

    public function saveWishlist($wishlist, $productId)
    {
        $wishlist->user_id = Auth::user()->id;
        $wishlist->product_id = $productId;
        $wishlist->save();
        return $wishlist;
    }

    public function saveComapreProduct($compare, $productId = null)
    {
        if (Auth::check()) {
            $compare->user_id = Auth::user()->id;
        }
        if ($productId) {
            $compare->product_id = $productId;
        }
        if (Session::has('compare_temp_id')) {
            $compare->compare_temp_id = Session::get('compare_temp_id');
        }
        $compare->save();
        return $compare;
    }

    public function randomKey()
    {
        $digits_needed = 17;

        $random_number = ''; // set up a blank string

        $count = 0;

        while ($count < $digits_needed) {
            $random_digit = mt_rand(0, 9);

            $random_number .= $random_digit;
            $count++;
        }

        return $random_number;
    }


    public function saveProductOrders($products, $userId, $shippingAddress, $shipping_type, $payment_type)
    {
        $uniqueId = $this->randomKey();
        foreach ($products as $product) {
            $order = new Order();
            $order->user_id = $userId;
            $order->product_id = $product->id;
            $order->quantity = $product->cart_quantity;
            $order->price = $product->price;

            $order->transaction_id = $uniqueId;
            $order->unique_order_id = $uniqueId;
            $order->address = $shippingAddress->address;
            if ($product->productColor) {
                $order->color = $product->productColor;
            }
            if ($product->productSize) {
                $order->size = $product->productSize;
            }
            $order->status = Order::PENDING;
            $order->shipping_method = $shipping_type;
            $order->payment_type = $payment_type;
            $order->save();
        }
        return $uniqueId;
    }

    public function saveSingleProductOrders($product, $userId, $shippingAddress, $shipping_type, $payment_type)
    {
        $uniqueId = $this->randomKey();

        $order = new Order();
        $order->user_id = $userId;
        $order->product_id = $product->id;
        $order->quantity = $product->cart_quantity;
        $order->price = $product->price;

        $order->transaction_id = $uniqueId;
        $order->unique_order_id = $uniqueId;
        $order->address = $shippingAddress->address;
        if ($product->productColor) {
            $order->color = $product->productColor;
        }
        if ($product->productSize) {
            $order->size = $product->productSize;
        }
        $order->status = Order::PENDING;
        $order->shipping_method = $shipping_type;
        $order->payment_type = $payment_type;
        $order->save();
        return $uniqueId;
    }

    public function getProductReviewsBYId($productId)
    {
        $productReviews = ProductReview::select('product_review.id', 'product_review.title', 'product_review.desc', 'product_review.created_at', 'product_review.rating', 'users.username')
            ->join('users', 'users.id', 'product_review.user_id')
            ->where('product_id', $productId)
            ->get();
        return $productReviews;
    }

    public function getSimilarProducts($product)
    {
        $similarProducts = Products::select('products.*', 'wishlist.id as wishlistId')
            ->leftJoin('wishlist', 'wishlist.product_id', 'products.id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->where('subcategories.id', $product->subId)
            ->where('products.id', '!=', $product->id)
            ->get();
        return $similarProducts;
    }

    public function getBestThreeSellerProducts()
    {
        $bestSellerProducts = ProductReview::select('products.*', 'product_review.rating', DB::raw("(select max('rating') from product_review)"))
            ->join('products', 'products.id', '=', 'product_review.product_id')
            ->orderBy('products.created_at', 'DESC')
            ->take(3)
            ->get();
        return $bestSellerProducts;
    }

    public function getBestSellerProducts($bestThreeSellerProducts)
    {
        $productId = [];
        foreach ($bestThreeSellerProducts as $product) {
            $productId[] = $product->id;
        }
        $bestSellerProducts = ProductReview::select('products.*', 'product_review.rating', DB::raw("(select max('rating') from product_review)"))
            ->join('products', 'products.id', '=', 'product_review.product_id')
            ->orderBy('products.created_at', 'DESC')
            ->whereNotIn('products.id', $productId)
            ->take(3)
            ->get();
        return $bestSellerProducts;
    }

    public function getDiscountProducts($min, $max)
    {
        $discountProducts = Products::select(DB::raw("products.id, products.name, products.brand_id, products.product_img, products.slug, products.price, (((products.price - product_discount.price) / products.price)  * 100) as percentage"))
            ->join('product_discount', 'products.id', '=', 'product_discount.product_id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->where(function ($query) {
                $query->where('product_discount.start_date', '<=', date('Y-m-d'))
                    ->where('product_discount.end_date', '>=', date('Y-m-d'));
            })
            ->having("percentage", "<=", $max)
            ->having("percentage", ">", $min)
            ->orderBy("percentage")
            ->get();
        return $discountProducts;
    }

    public function getSellProducts($productId)
    {
        $onSellProducts = Products::select(DB::raw(" products.* , (((products.price - product_discount.price) / products.price)  * 100) as percentage"))
            ->join('product_discount', 'products.id', '=', 'product_discount.product_id')
            ->where(function ($query) {
                $query->where('product_discount.start_date', '<=', date('Y-m-d'))
                    ->where('product_discount.end_date', '>=', date('Y-m-d'));
            })
            ->orderBy("percentage")
            ->where('products.id', '!=', $productId)
            ->take(3)
            ->get();
        return $onSellProducts;
    }

    public function getcategorySellProduct()
    {
        $onSellProducts = Products::select(DB::raw(" products.* , (((products.price - product_discount.price) / products.price)  * 100) as percentage"))
            ->join('product_discount', 'products.id', '=', 'product_discount.product_id')
            ->where(function ($query) {
                $query->where('product_discount.start_date', '<=', date('Y-m-d'))
                    ->where('product_discount.end_date', '>=', date('Y-m-d'));
            })
            ->orderBy("percentage")
            ->take(5)
            ->get();
        return $onSellProducts;
    }

    public function getNewArrivalsProducts()
    {
        $newArrivalsProducts = Products::select('products.id', 'products.name', 'products.product_img', 'products.slug', 'products.price')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('products.status', 1)
            ->where('products.new_arrival', 1)
            ->orderBy('products.created_at', 'DESC')
            ->get();
        return $newArrivalsProducts;
    }

    public function getSpecialProducts()
    {
        $specialProducts = Products::select('products.id', 'products.name', 'products.product_img', 'products.slug', 'products.price')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('products.status', 1)
            ->where('products.special', 1)
            ->orderBy('products.created_at', 'DESC')
            ->get();
        return $specialProducts;
    }

    public function getSpecialProduct()
    {
        $specialProducts = Products::select('products.id', 'products.name', 'products.product_img', 'products.slug', 'products.price')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('products.status', 1)
            ->where('products.special', 1)
            ->orderBy('products.created_at', 'DESC')
            ->first();
        return $specialProducts;
    }

    public function getRecommendProducts()
    {
        $recommendProducts = Products::select('products.id', 'products.name', 'products.product_img', 'products.slug', 'products.price')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('products.status', 1)
            ->where('products.recommend', 1)
            ->orderBy('products.created_at', 'DESC')
            ->get();
        return $recommendProducts;
    }

    public function getTopSellerProducts()
    {
        $bestSellerProducts = Products::select('products.id', 'products.name', 'products.product_img', 'products.slug', 'products.price', 'product_review.rating', DB::raw("(select max('rating') from product_review)"))
            ->join('product_review', 'product_review.product_id', '=', 'products.id')
            ->where('products.status', 1)
            ->orderBy('products.created_at', 'DESC')
            ->take(6)
            ->get();
        return $bestSellerProducts;
    }

    public function getCategoryProducts($categoryId, $type)
    {
        $products = Products::select("products.*")
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('products.status', 1)
            ->where('products.' . $type, 1)
            ->where('categories.id', $categoryId)
            ->orderBy('products.created_at', 'DESC')
            ->get();
        return $products;
    }

    public function getTopSellerCatProducts($categoryId)
    {
        $bestSellerProducts = Products::select('products.id', 'products.name', 'products.product_img', 'products.slug', 'products.price', 'product_review.rating', DB::raw("(select max('rating') from product_review)"))
            ->join('product_review', 'product_review.product_id', '=', 'products.id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('products.status', 1)
            ->where('categories.id', $categoryId)
            ->where('products.status', 1)
            ->orderBy('products.created_at', 'DESC')
            ->get();
        return $bestSellerProducts;
    }

    public function to_string($data, $glue = ', ')
    {
        $output = '';
        if (!empty($data) && count($data) > 0) {
            $values = array_values($data);
            $output = join($glue, $values);
        }
        return $output;
    }
}