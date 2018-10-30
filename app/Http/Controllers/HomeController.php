<?php

namespace App\Http\Controllers;

use App\Classes\MailService;
use App\Classes\UserManager;
use App\Model\Brands;
use App\Model\Cart;
use App\Model\Categories;
use App\Model\ColorsImages;
use App\Model\City;
use App\Model\Compare;
use App\Model\HomepageSlider;
use App\Model\Order;
use App\Model\ProductReview;
use App\Model\Products;
use App\Model\ProductsAttributes;
use App\Model\ProductsSliders;
use App\Model\RechargeHistory;
use App\Model\ShippingAddress;
use App\Model\States;
use App\Model\SubCategory;
use App\Model\SubCategory2;
use App\Model\SubcategorySlider;
use App\Model\Testimonials;
use App\Model\User;
use App\Model\WalletHistory;
use App\Model\Wishlist;
use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Softon\Indipay\Facades\Indipay;
// use Session;

class HomeController extends Controller
{
    /**
     * @var UserManager
     */
    protected $user;

    private $userManager;
    /**
     * @var MailService
     */
    private $mailService;

    public function __construct(UserManager $userManager, MailService $mailService)
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            if (auth()->user() && auth()->user()->hasRole('admin') || auth()->user() && auth()->user()->hasRole('seller')) {
                Auth::logout();
                return redirect('/');
            }
            return $next($request);
        });
        $this->userManager = $userManager;
        $this->mailService = $mailService;
    }

    public function getHomepage()
    {
        $newArrivalsCategories = Categories::select('id', 'name')->where('new_arrival', 1)->get();
        $topSellerCategories = Categories::select('id', 'name')->where('top_seller', 1)->get();
        $specialCategories = Categories::select('id', 'name')->where('special', 1)->get();
        $recommendCategories = Categories::select('id', 'name')->where('recommend', 1)->get();

        $newArrivalsProducts = $this->userManager->getNewArrivalsProducts();
        $specialProducts = $this->userManager->getSpecialProducts();
        $recommendProducts = $this->userManager->getRecommendProducts();
        $topSellerProducts = $this->userManager->getTopSellerProducts();

        $upTo40Discounts = $this->userManager->getDiscountProducts('1', '40');
        $upTo50Discounts = $this->userManager->getDiscountProducts('41', '50');
        $upTo60Discounts = $this->userManager->getDiscountProducts('51', '60');
        $upTo70Discounts = $this->userManager->getDiscountProducts('61', '70');
        $upTo80Discounts = $this->userManager->getDiscountProducts('71', '80');

        $mainSliders = HomepageSlider::select('id', 'main_slider', 'url')->where('main_slider', '!=', NULL)->take(5)->get();
        $smallSlider1 = HomepageSlider::select('id', 'small_slider', 'url')->where('small_slider', '!=', NULL)->limit(1)->first();
        $smallSlider2 = HomepageSlider::select('id', 'small_slider', 'url')->where('small_slider', '!=', NULL)->skip(1)->take(1)->first();
        $mediumSlider1 = HomepageSlider::select('id', 'medium_slider', 'url')->where('medium_slider', '!=', NULL)->take(1)->first();
        $mediumSlider2 = HomepageSlider::select('id', 'medium_slider', 'url')->where('medium_slider', '!=', NULL)->skip(1)->take(1)->first();
        $newArrivalSliders = HomepageSlider::select('id', 'new_arrival_slider', 'url')->where('new_arrival_slider', '!=', NULL)->take(3)->get();
        $topSellerSliders = HomepageSlider::select('id', 'top_seller_slider', 'url')->where('top_seller_slider', '!=', NULL)->take(3)->get();
        $topSellerHorizontalSliders = HomepageSlider::select('id', 'seller_horizontal_slider', 'url')->where('seller_horizontal_slider', '!=', NULL)->take(2)->get();
        $specialSliders = HomepageSlider::select('id', 'special_product_slider', 'url')->take(3)->where('special_product_slider', '!=', NULL)->get();
        $recommendSliders = HomepageSlider::select('id', 'recommend_slider', 'url')->where('recommend_slider', '!=', NULL)->take(3)->get();
        $footerImage = HomepageSlider::select('id', 'footer_slider')->where('footer_slider', '!=', NULL)->first();

        return view('front.pages.homepage', compact('footerImage', 'recommendSliders', 'specialSliders', 'mainSliders', 'smallSlider1', 'smallSlider2', 'mediumSlider1', 'mediumSlider2', 'newArrivalSliders', 'topSellerSliders', 'topSellerHorizontalSliders', 'newArrivalsProducts', 'specialProducts', 'recommendProducts', 'topSellerProducts', 'prepaid', 'postpaid', 'dataCard', 'dth', 'upTo40Discounts', 'upTo50Discounts', 'upTo60Discounts', 'upTo70Discounts', 'upTo80Discounts', 'newArrivalsCategories', 'topSellerCategories', 'specialCategories', 'recommendCategories'));
    }

    public function getCategoryProducts(Request $request)
    {
        if ($request->get('catId') == 'all') {
            $type = $request->get('type');
            switch ($type) {
                case "new_arrival":
                    $products = $this->userManager->getNewArrivalsProducts();
                    break;
                case "special":
                    $products = $this->userManager->getSpecialProducts();
                    break;
                default:
                    $products = $this->userManager->getRecommendProducts();
            }

            return view('front.pages.product.category_products', compact('products'));
        } else {
            $category = Categories::find($request->get('catId'));
            if (!$category) {
                return response()->json([
                    'error' => true,
                    'message' => 'Category not found..!'
                ]);
            }
            $products = $this->userManager->getCategoryProducts($category->id, $request->get('type'));

            return view('front.pages.product.category_products', compact('products'));
        }

    }

    public function getTopSellerProducts(Request $request)
    {
        if ($request->get('catId') == 'all') {
            $products = $this->userManager->getTopSellerProducts();
            return view('front.pages.product.category_products', compact('products'));
        } else {
            $category = Categories::find($request->get('catId'));
            if (!$category) {
                return response()->json([
                    'error' => true,
                    'message' => 'Category not found..!'
                ]);
            }
            $products = $this->userManager->getTopSellerCatProducts($category->id);

            return view('front.pages.product.category_products', compact('products'));
        }
    }

    public
    function getUserProfile()
    {
        $shippingAddress = ShippingAddress::where('user_id', Auth::user()->id)->get();
        return view('front.pages.user_profile', compact('rechargeOrders', 'shippingAddress'));
    }

    public
    function getUserProfileForm()
    {
        $stateCity = City::select('id', 'name')->get();
        $states = States::select('id', 'name', 'code')->orderBy('name', 'ASC')->get();
        return view('front.pages.user_profile_form', compact('states', 'stateCity'));
    }

    public
    function postUserProfileForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'mobile_num' => 'required|regex:/[0-9]{10}/|digits:10',
            'birth_date' => 'required',
            'gender' => 'required|in:male,female',
            'state' => 'required',
            'city' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }
        $user = Auth::user();
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->mobile_num = $request->get('mobile_num');
        $user->birth_date = Carbon::parse($request->get('birth_date'))->format('d-m-Y');
        $user->gender = $request->get('gender');
        $state = States::where('code', $request->get('state'))->first();
        $user->state = $state->name;
        $city = City::find($request->get('city'));
        $user->city = $city->name;
        $user->save();

        Session::flash('success', 'Profile updated successfully..!');
        return response()->json([
            'success' => true,
        ]);
    }

    public
    function getProductDetail($slug)
    {
        // $product = Products::select('products.id', 'products.name', 'products.product_img', 'products.price', 'products.slug', 'products.quantity', 'products.desc', 'products.video_id', 'products.video_thumb', 'subcategories.id as subId', 'subcategories.name as subCatName', 'categories.name as CatName', 'users.username')
        //     ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
        //     ->join('categories', 'categories.id', '=', 'subcategories.category_id')
        //     ->join('users', 'users.id', '=', 'products.user_id')
        //     ->where('products.slug', $slug)
        //     ->limit(1)
        //     ->first();

        $product = Products::select('products.id', 'products.name', 'products.product_img', 'products.price', 'products.slug', 'products.quantity', 'products.desc', 'products.video_id', 'products.url', 'products.video_thumb', 'subcategories.id as subId', 'subcategories.name as subCatName', 'subcategories2.name as subCatName2', 'categories.name as CatName', 'users.username')
            ->join('subcategories2', 'subcategories2.id', '=', 'products.sub_category_id')
            ->join('subcategories', 'subcategories.id', '=', 'subcategories2.subcategory_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->where('products.slug', $slug)
            ->limit(1)
            ->first();

        $productReviews = $this->userManager->getProductReviewsBYId($product->id);

        $similarProducts = $this->userManager->getSimilarProducts($product);

        $bestThreeSellerProducts = $this->userManager->getBestThreeSellerProducts();
        $bestSellerProducts = $this->userManager->getBestSellerProducts($bestThreeSellerProducts);

        $onSellProducts = $this->userManager->getSellProducts($product->id);

        $categories = Categories::select('id', 'name', 'slug')->get();

        // $productColors = ProductsAttributes::select('product_attributes.id', 'product_attributes.desc','product_screenshots.screenshots','product_attributes.product_price')->join('product_screenshots','product_screenshots.id','product_attributes.image_id')->where('product_attributes.product_id', $product->id)->where('name', 'color')->orderBy('desc')->get();

        $productColors = ProductsAttributes::select('product_attributes.id', 'product_attributes.desc','colors_images.image1','product_attributes.product_price')->join('colors_images','colors_images.attribute_id','product_attributes.id')->where('product_attributes.product_id', $product->id)->where('name', 'color')->orderBy('desc')->get();

        $productSizes = ProductsAttributes::select('id', 'desc')->where('product_id', $product->id)->where('name', 'size')->get();

        $mainSliders = ProductsSliders::select('id', 'main_slider', 'url')->where('main_slider', '!=', NULL)->take(3)->get();
        $sidebarSlider = ProductsSliders::select('id', 'sidebar_slider', 'url')->where('sidebar_slider', '!=', NULL)->first();
        $products = [];
        $maxelements = 5;
        // if (isset($_COOKIE['recentviews']) && $_COOKIE['recentviews']) {
        //     $pro = stripslashes($_COOKIE['recentviews']);
        //     $recentProductsId = json_decode($pro, true);
        //     if (!in_array($product->id, $recentProductsId)) {
        //         array_push($recentProductsId, $product->id);
        //         $products = $recentProductsId;
        //     } else {
        //         $products = $recentProductsId;
        //     }
        //     $json = json_encode($products);
        // } else {
        //     $products[] = $product->id;
        //     $json = json_encode($products);
        // }
        // setcookie('recentviews', $json, time() + (86400 * 30));

        // if (isset($_COOKIE['recentviews'])) {
        //     $cookie = $_COOKIE['recentviews'];
        //     $pro = stripslashes($cookie);
        //     $recentProductsId = json_decode($pro, true);
        //     if (count($recentProductsId) > $maxelements) {//check the number of array elements
        //         $recentProductsId = array_slice($recentProductsId, 1); // remove the first element if we have 5 already
        //     }
        // }
        // if (isset($recentProductsId)) {
        //     $recentViewsProducts = Products::select(DB::raw(" products.* , (((products.price - product_discount.price) / products.price)  * 100) as percentage"))
        //         ->leftJoin('product_discount', 'products.id', '=', 'product_discount.product_id')
        //         ->whereIn('products.id', $recentProductsId)
        //         ->get();
        // }
        // 
        if (Session::has('recentviews')) {
            $pro = stripslashes(Session::get('recentviews'));
            $recentProductsId = json_decode($pro, true);
            if (!in_array($product->id, $recentProductsId)) {
                array_push($recentProductsId, $product->id);
                $products = $recentProductsId;
            } else {
                $products = $recentProductsId;
            }
            $json = json_encode($products);
        } else {
            $products[] = $product->id;
            $json = json_encode($products);
        }
        Session::put('recentviews', $json);
        // Session(['recentviews', $json]);
        

        if (Session::has('recentviews')) {
            $cookie = Session::get('recentviews');
            $pro = stripslashes($cookie);
            $recentProductsId = json_decode($pro, true);
            if (count($recentProductsId) > $maxelements) {//check the number of array elements
                $recentProductsId = array_slice($recentProductsId, 1); // remove the first element if we have 5 already
            }
        }
        if (isset($recentProductsId)) {
            $recentViewsProducts = Products::select(DB::raw(" products.* , (((products.price - product_discount.price) / products.price)  * 100) as percentage"))
                ->leftJoin('product_discount', 'products.id', '=', 'product_discount.product_id')
                ->whereIn('products.id', $recentProductsId)
                ->get();
        }




        $productSizesColors = ProductsAttributes::select('id', 'desc')->where('product_id', $product->id)->where('name', 'size_color')->get();


        return view('front.pages.product_detail', compact('sidebarSlider', 'mainSliders', 'product', 'recentViewsProducts', 'categories', 'productColors', 'onSellProducts', 'productSizes', 'similarProducts', 'productReviews', 'bestSellerProducts', 'bestThreeSellerProducts','productSizesColors'));
    }

    public
    function getAddToCart(Request $request)
    {
        if (!Auth::check()) {
            if (!Session::has('cart_temp_id')) {
                $cartTempId = uniqid();
                Session::put('cart_temp_id', $cartTempId);
            }
        }
        $product = Products::where('slug', $request->get('slug'))->limit(1)->first();
        if (!$product) {
            return response()->json([
                'error' => true,
                'message' => 'Product not found'
            ]);
        }
        if (Cart::where('product_id', $product->id)->limit(1)->first()) {
            $cart = Cart::where('product_id', $product->id)->limit(1)->first();
        } else {
            $cart = new Cart();
        }
        if (Auth::check()) {
            $cart->user_id = Auth::user()->id;
        }
        $cart->product_id = $product->id;
        if (count($product->getDiscountPrice()) > 0) {
            $cart->price = $product->getDiscountPrice();
        } else {
            // $cart->price = $product->price;
            $cart->price =  $request->get('price');
        }
        if ($request->get('color')) {
            $cart->color = $request->get('color');
        }
        if ($request->get('product_qty')) {
            $cart->quantity = $request->get('product_qty');
        } else {
            $cart->quantity = 1;
        }
        if ($request->get('size')) {
            $cart->size = $request->get('size');
        }
        if (Session::has('cart_temp_id')) {
            $cart->cart_temp_id = Session::get('cart_temp_id');
        }
        $cart->save();

        return response()->json([
            'success' => true,
            'message' => 'Product added in cart..!'
        ]);
    }

    public
    function getCart()
    {
        if (Auth::check()) {
            $cartDetails = $this->userManager->getAuthUserCartDetails();
            $cartCount = Cart::where('user_id', Auth::user()->id)->count();
            $totalPrice = $this->userManager->getAuthUserTotalPrice();
        } else {
            $cartCount = Cart::where('cart_temp_id', Session::get('cart_temp_id'))->count();

            $cartDetails = $this->userManager->getUserCartDetails();

            $totalPrice = $this->userManager->getUserTotalPrice();
        }
        return view('front.auth.layout.include.cart', compact('cartCount', 'cartDetails', $totalPrice));
    }

    public
    function getRemoveCartProduct($slug)
    {
        $product = Products::where('slug', $slug)->limit(1)->first();
        if (!$product) {
            Session::flash('error', 'Product not found..!');
            return redirect()->back();
        }
        $cart = Cart::where('product_id', $product->id)->limit(1)->first();
        if (!$cart) {
            Session::flash('error', 'Something is wrong please try again..!');
            return redirect()->back();
        }
        $cart->delete();
        Session::flash('success', 'Product remove from cart..!');
        return redirect()->back();
    }

    public function getOrder($transaction_id = null)
    {
        if ($transaction_id) {
            $recharge = RechargeHistory::select('recharge_history.*', 'services.name as serviceName', 'operators.name')
                ->join('services', 'services.id', 'recharge_history.service_id')
                ->join('operators', 'operators.id', 'recharge_history.operator_id')
                ->where('transaction_id', $transaction_id)
                ->first();
            return view('front.pages.order', compact('recharge'));
        } else {
            if (Auth::check()) {
                $products = $this->userManager->getAuthUserCartDetails();
            } else {
                $products = $this->userManager->getUserCartDetails();
            }
            return view('front.pages.order', compact('products'));
        }
    }

    public function getCheckout()
    {
        if (Auth::check()) {
            $products = $this->userManager->getAuthUserCartDetails();
            $shippingAddress = ShippingAddress::where('user_id', Auth::user()->id)->get();
        } else {
            $products = $this->userManager->getUserCartDetails();
        }
        return view('front.pages.checkout', compact('products', 'shippingAddress'));
    }

    public function postProductOrder(Request $request)
    {
        $shippingAddress = ShippingAddress::where('user_id', Auth::user()->id)->where('status', 1)->first();
        if (!$shippingAddress) {
            Session::flash('error', 'Please select address or add address..!');
            return redirect()->back();
        }
        $products = $this->userManager->getAuthUserCartDetails();
        DB::beginTransaction();
        try {
            if ($request->get('shipping_type') == \App\Model\ShippingAddress::FREE && $request->get('payment_type') == Order::CASHONDELIVERY) {
                $uniqueId = $this->userManager->saveProductOrders($products, Auth::user()->id, $shippingAddress, $request->get('shipping_type'), $request->get('payment_type'));
                foreach ($products as $cartProduct) {
                    $cartProduct->delete();
                }
                DB::commit();
                Session::flash('success', 'Your order successfully placed..!');
                return redirect()->route('get:order_summary', $uniqueId);
            } elseif ($request->get('shipping_type') == \App\Model\ShippingAddress::FREE && $request->get('payment_type') == Order::DEBITCARD) {
                $uniqueId = $this->userManager->saveProductOrders($products, Auth::user()->id, $shippingAddress, $request->get('shipping_type'), $request->get('payment_type'));
                $amount = \Illuminate\Support\Facades\Auth::user()->cartTotalPrice();
                $parameters = [
                    'merchant_id' => env('INDIPAY_MERCHANT_ID'),
                    'currency' => 'INR',
                    'redirect_url' => env('APP_URL') . '/indipay/response',
                    'cancel_url' => env('APP_URL') . '/indipay/response',
                    'language' => 'EN',
                    'order_id' => $uniqueId,
                    'tid' => $uniqueId,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->mobile_num,
                    'amount' => "$amount",
                ];
                $order = Indipay::gateway('CCAvenue')->prepare($parameters);
                DB::commit();
                return Indipay::process($order);
            } elseif ($request->get('shipping_type') == \App\Model\ShippingAddress::STANDARD && $request->get('payment_type') == Order::DEBITCARD) {
                $uniqueId = $this->userManager->saveProductOrders($products, Auth::user()->id, $shippingAddress, $request->get('shipping_type'), $request->get('payment_type'));
                $amount = $request->get('amount');
                $parameters = [
                    'tid' => $uniqueId,
                    'order_id' => $uniqueId,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->mobile_num,
                    'amount' => "$amount",
                ];
                $order = Indipay::prepare($parameters);
                DB::commit();
                return Indipay::process($order);
            } else {
                Session::flash('error', 'This type of payment not available in your area..!');
                return redirect()->back();
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e);
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong !'
            ]);
        }
    }

    public
    function getOrderSummary($uniqueId)
    {
        $orders = Order::select('order.id', 'order.transaction_id', 'order.color', 'order.size', 'order.status', 'order.price', 'order.quantity as cart_quantity', 'products.name', 'products.slug', 'products.product_img', 'order.quantity', DB::raw('order.quantity * order.price as total'))
            ->join('products', 'products.id', 'order.product_id')
            ->where('order.unique_order_id', $uniqueId)
            ->get();
        return view('front.pages.order_success', compact('orders', 'uniqueId'));
    }

    public function postShippingAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pin_code' => 'required|regex:/\b\d{6}\b/',
            'mobile_num' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors(),
            ]);
        }
        $shippingAddress = new ShippingAddress();
        $shippingAddress->user_id = Auth::user()->id;
        $shippingAddress->first_name = $request->get('first_name');
        $shippingAddress->last_name = $request->get('last_name');
        $shippingAddress->city = $request->get('city');
        $shippingAddress->state = $request->get('state');
        $shippingAddress->pin_code = $request->get('pin_code');
        $shippingAddress->mobile_num = $request->get('mobile_num');
        $shippingAddress->address = $request->get('address');
        $shippingAddress->save();

        Session::flash('success', 'Shipping address added successfully..!');
        return response()->json([
            'success' => true,
            'message' => $validator->errors(),
        ]);
    }

    public
    function getSelectShippingAddress(Request $request)
    {
        $address = ShippingAddress::find($request->get('shippingId'));
        if (!$address) {
            return response()->json([
                'error' => true
            ]);
        }
        $allAddress = ShippingAddress::all();
        foreach ($allAddress as $addr) {
            $addr->status = 0;
            $addr->save();
        }
        $address->status = 1;
        $address->save();
        return response()->json([
            'success' => true
        ]);
    }

    public
    function getShippingAddressForm()
    {
        return view('front.pages.include.shipping_address_form');
    }

    public
    function postUpdateCartQuantity(Request $request)
    {
        $cart = Cart::find($request->get('cartId'));
        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'Cart not updated something is wrong..!'
            ]);
        }
        $product = Products::find($cart->product_id);
        if ($request->get('quantity') > $product->quantity) {
            return response()->json([
                'success' => false,
                'message' => "We're sorry! Only " . $product->quantity . " units of " . $product->name . " for each customer."
            ]);
        }
        $cart->quantity = $request->get('quantity');
        $cart->save();
        Session::flash('success', 'Cart updated successfully');
        return response()->json([
            'success' => true,
        ]);
    }

    public
    function getDeleteShippingAddress(Request $request)
    {
        $address = ShippingAddress::find($request->get('shippingId'));
        if (!$address) {
            return response()->json([
                'error' => true
            ]);
        }
        $address->delete();
        Session::flash('success', 'Address delete successfully..!');
        return response()->json([
            'success' => true,
        ]);
    }

    public
    function getAddToWishlist(Request $request)
    {
        // return $request->all();
        $product = Products::find($request->get('productId'));
        if (!$product) {
            return response()->json([
                'error' => true,
                'message' => 'Product not found'
            ]);
        }
        if (Wishlist::where('product_id', $product->id)->limit(1)->first()) {
            $wishlist = Wishlist::where('product_id', $product->id)->limit(1)->first();
            $wishlist->delete();
            return response()->json([
                'success' => true,
                'message' => 'Removed from your Wishlist..!',
                'added' => 0
            ]);

        } else {
            $wishlist = new Wishlist();
            $this->userManager->saveWishlist($wishlist, $product->id);
            return response()->json([
                'success' => true,
                'message' => 'Added to your wishlist..!',
                'added' => 1
            ]);
        }
    }

    public
    function getWishlistCount()
    {
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->get();
        if ($wishlist) {
            return response()->json([
                'success' => true,
                'count' => count($wishlist)
            ]);
        }
    }

    public
    function getWishList()
    {
        $wishlists = Wishlist::select('products.id', 'products.name', 'products.product_img', 'products.slug', 'products.price', 'products.quantity', 'wishlist.id as wishlistId')->join('products', 'products.id', 'wishlist.product_id')->where('wishlist.user_id', Auth::user()->id)->get();


        $products = [];
        $maxelements = 5;
        // if (isset($_COOKIE['recentviews']) && $_COOKIE['recentviews']) {
        //     $pro = stripslashes($_COOKIE['recentviews']);
        //     $recentProductsId = json_decode($pro, true);
        //     if (!in_array($product->id, $recentProductsId)) {
        //         array_push($recentProductsId, $product->id);
        //         $products = $recentProductsId;
        //     } else {
        //         $products = $recentProductsId;
        //     }
        //     $json = json_encode($products);
        // } else {
        //     $products[] = $product->id;
        //     $json = json_encode($products);
        // }
        // setcookie('recentviews', $json, time() + 86400);
            // echo "<pre>";
            // print_r($_COOKIE);
            // die;
        // if (isset($_COOKIE['recentviews'])) {
        //     $pro = stripslashes($cookie);
        //     $recentProductsId = json_decode($pro, true);
        //     if (count($recentProductsId) > $maxelements) {//check the number of array elements
        //         $recentProductsId = array_slice($recentProductsId, 1); // remove the first element if we have 5 already
        //     }
        // }
        // if (isset($recentProductsId)) {
        //     return $recentProductsId;
        //     $recentViewsProducts = Products::select(DB::raw(" products.* , (((products.price - product_discount.price) / products.price)  * 100) as percentage"))
        //         ->leftJoin('product_discount', 'products.id', '=', 'product_discount.product_id')
        //         ->whereIn('products.id', $recentProductsId)
        //         ->get();
        // }

        if (Session::has('recentviews')) {
            $cookie = Session::get('recentviews');
            $pro = stripslashes($cookie);
            $recentProductsId = json_decode($pro, true);
            if (count($recentProductsId) > $maxelements) {//check the number of array elements
                $recentProductsId = array_slice($recentProductsId, 1); // remove the first element if we have 5 already
            }
        }
        if (isset($recentProductsId)) {
            $recentViewsProducts = Products::select(DB::raw(" products.* , (((products.price - product_discount.price) / products.price)  * 100) as percentage"))
                ->leftJoin('product_discount', 'products.id', '=', 'product_discount.product_id')
                ->whereIn('products.id', $recentProductsId)
                ->get();
        }

        // return $recentViewsProducts;

        return view('front.pages.wish_list', compact('wishlists','recentViewsProducts'));
    }

    public
    function getAddToCompare(Request $request)
    {
        $product = Products::find($request->get('productId'));
        if (!$product) {
            return response()->json([
                'error' => true,
                'message' => 'Product not found'
            ]);
        }
        if (!Auth::check()) {
            if (!Session::has('compare_temp_id')) {
                $compareTempId = uniqid();
                Session::put('compare_temp_id', $compareTempId);
            }
            $notAuthCompare = Compare::where('product_id', $product->id)->where('compare_temp_id', Session::get('compare_temp_id'))->limit(1)->first();
            if ($notAuthCompare) {
                $notAuthCompare->delete();
                $count = count(Compare::where('compare_temp_id', Session::get('compare_temp_id'))->get());
                if ($count == 3) {
                    return response()->json([
                        'error' => true,
                        'message' => 'You have already selected 3 products..!',
                    ]);
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Removed from your compare list..!',
                    'added' => 0,
                    'count' => $count
                ]);
            }
        }
        if (Auth::check()) {
            $authCompare = Compare::where('product_id', $product->id)->where('user_id', Auth::user()->id)->limit(1)->first();
            if ($authCompare) {
                $authCompare->delete();
                $count = count(Compare::where('user_id', Auth::user()->id)->get());

                if ($count == 3) {
                    return response()->json([
                        'error' => true,
                        'message' => 'You have already selected 3 products..!',
                    ]);
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Removed from your compare list..!',
                    'added' => 0,
                    'count' => $count
                ]);
            } else {
                $compare = new Compare();
                if (Auth::check()) {
                    $count = count(Compare::where('user_id', Auth::user()->id)->get());
                } else {
                    $count = count(Compare::where('compare_temp_id', Session::get('compare_temp_id'))->get());
                }
                if ($count == 3) {
                    return response()->json([
                        'error' => true,
                        'message' => 'You have already selected 3 products..!',
                    ]);
                }

                $com = Compare::first();
                if ($com) {
                    $products = Products::find($com->product_id);
                    if ($products) {
                        if ($products->sub_category_id != $product->sub_category_id) {
                            return response()->json([
                                'error' => true,
                                'message' => 'This product not compare..!',
                            ]);
                        }
                    }
                }
                $compare = $this->userManager->saveComapreProduct($compare, $product->id);
                return response()->json([
                    'success' => true,
                    'message' => 'Added to your compare list..!',
                    'added' => 1,
                    'count' => count($compare)
                ]);
            }
        }
    }

    public
    function getCompareBtn()
    {
        if (Auth::check()) {
            $compare = Compare::where('user_id', Auth::user()->id)->get();
        } else {
            $compare = Compare::where('compare_temp_id', Session::get('compare_temp_id'))->get();
        }
        return view('front.pages.include.compare_btn', compact('compare'));
    }

    public
    function getCompare()
    {
        if (Auth::check()) {
            $compareProducts = Compare::join('products', 'products.id', 'compare.product_id')
                ->where('compare.user_id', Auth::user()->id)
                ->get();
        } else {
            $compareProducts = Compare::join('products', 'products.id', 'compare.product_id')
                ->where('compare.compare_temp_id', Session::get('compare_temp_id'))
                ->get();
        }
        return view('front.pages.compare', compact('compareProducts'));
    }

    public
    function getRemoveFromCompare(Request $request)
    {
        $compare = Compare::where('product_id', $request->get('productId'))->limit(1)->first();
        if (!$compare) {
            return response()->json([
                'error' => true,
                'message' => 'Compare product not found'
            ]);
        }
        $compare->delete();
        Session::flash('success', 'Product remove form compare list..!');
        return response()->json([
            'success' => true,
            'message' => 'Product remove form compare list..!'
        ]);
    }

    public function getSubCategoryProducts($catSlug, $slug)
    {
        $subcategory = SubCategory::where('slug', $slug)->limit(1)->first();
        if (!$subcategory) {
            abort(404, 'Data not found');
        }

        $products = Products::select('products.*', 'subcategories2.id as subCatId', 'wishlist.id as wishlistId')
            ->join('subcategories2', 'subcategories2.id', '=', 'products.sub_category_id')
            ->join('subcategories', 'subcategories.id', '=', 'subcategories2.subcategory_id')
            ->leftJoin('wishlist', 'wishlist.product_id', 'products.id')
            ->where('subcategories.slug', $subcategory->slug)
            ->where('products.status', 1)
            ->paginate(18);

        // $products = Products::select('products.*', 'subcategories.id as subCatId', 'wishlist.id as wishlistId')
        //     ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
        //     ->leftJoin('wishlist', 'wishlist.product_id', 'products.id')
        //     ->where('subcategories.slug', $subcategory->slug)
        //     ->where('products.status', 1)
        //     ->paginate(18);

        $productId = [];
        foreach ($products as $product) {
            $price = $product->getDiscountPrice();
            if ($price) {
                $productId[] = $price;
            } else {
                $productId[] = $product->price;
            }
        }
        if (count($productId) > 0) {
            $max = max($productId);
            $min = min($productId);
        } else {
            $max = 0;
            $min = 0;
        }


            // ->join('subcategories2', 'subcategories2.id', '=', 'products.sub_category_id')
            // ->join('subcategories', 'subcategories.id', '=', 'subcategories2.subcategory_id')

        $productBrands = Brands::select('brands.id as brandId')
            ->join('products', 'products.brand_id', '=', 'brands.id')
            ->join('subcategories2', 'subcategories2.id', '=', 'products.sub_category_id')
            ->join('subcategories', 'subcategories.id', '=', 'subcategories2.subcategory_id')
            ->where('subcategories.id', $subcategory->id)
            ->groupBy('brandId')
            ->get();

        // $productBrands = Brands::select('brands.id as brandId')
        //     ->join('products', 'products.brand_id', '=', 'brands.id')
        //     ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
        //     ->where('subcategories.slug', $subcategory->slug)
        //     ->groupBy('brandId')
        //     ->get();


        $colors = ProductsAttributes::select('product_attributes.id', 'product_attributes.desc')
            ->join('products', 'products.id', '=', 'product_attributes.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->where('subcategories.slug', $subcategory->slug)
            ->where('product_attributes.name', 'color')
            ->get();

        $productColors = [];
        $color = [];
        foreach ($colors as $productColor) {
            if (!in_array("$productColor->desc", $color)) {
                $color[] = $productColor->desc;
                $productColors[] =
                    [
                        'id' => $productColor->id,
                        'color' => $productColor->desc,
                    ];
            }
        }

        $prodSizes = ProductsAttributes::select('product_attributes.id', 'product_attributes.desc')
            ->join('products', 'products.id', '=', 'product_attributes.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->where('subcategories.slug', $subcategory->slug)
            ->where('product_attributes.name', 'size')
            ->get();

        $productSizes = [];
        $size = [];
        foreach ($prodSizes as $productSize) {
            if (!in_array("$productSize->desc", $size)) {
                $size[] = $productSize->desc;
                $productSizes[] =
                    [
                        'id' => $productSize->id,
                        'size' => $productSize->desc,
                    ];
            }
        }

        $specialProduct = $this->userManager->getSpecialProduct();
        $mainSliders = SubcategorySlider::select('id', 'main_slider')->where('main_slider', '!=', NULL)->take(5)->get();
        $sidebarSliders = SubcategorySlider::select('id', 'sidebar_slider')->where('sidebar_slider', '!=', NULL)->limit(3)->get();
        $category = Categories::where('slug', $catSlug)->first();
        $testimonials = Testimonials::select('title', 'desc', 'image')->get();

        $onSellProducts = $this->userManager->getcategorySellProduct();


        return view('front.pages.sub_category_product', compact('testimonials', 'mainSliders', 'sidebarSliders', 'products', 'category', 'subcategory', 'max', 'min', 'productBrands', 'productColors', 'productSizes', 'specialProduct','onSellProducts'));
    }


    public function getSubCategory2Products($cat, $subcat, $subcat2)
    {
        $subcategory2 = SubCategory2::where('slug', $subcat2)->limit(1)->first();
        if (!$subcategory2) {
            abort(404, 'Data not found');
        }

        $products = Products::select('products.*', 'subcategories2.id as subCat2Id', 'wishlist.id as wishlistId')
            ->join('subcategories2', 'subcategories2.id', '=', 'products.sub_category_id')
            ->leftJoin('wishlist', 'wishlist.product_id', 'products.id')
            ->where('subcategories2.slug', $subcategory2->slug)
            ->where('products.status', 1)
            ->paginate(18);

        $productId = [];
        foreach ($products as $product) {
            $price = $product->getDiscountPrice();
            if ($price) {
                $productId[] = $price;
            } else {
                $productId[] = $product->price;
            }
        }
        if (count($productId) > 0) {
            $max = max($productId);
            $min = min($productId);
        } else {
            $max = 0;
            $min = 0;
        }

        $productBrands = Brands::select('brands.id as brandId')
            ->join('products', 'products.brand_id', '=', 'brands.id')
            ->join('subcategories2', 'subcategories2.id', '=', 'products.sub_category_id')
            ->where('subcategories2.id', $subcategory2->id)
            ->groupBy('brandId')
            ->get();

      
        $colors = ProductsAttributes::select('product_attributes.id', 'product_attributes.desc')
            ->join('products', 'products.id', '=', 'product_attributes.product_id')
            ->join('subcategories2', 'subcategories2.id', '=', 'products.sub_category_id')
            ->where('subcategories2.slug', $subcategory2->slug)
            ->where('product_attributes.name', 'color')
            ->get();

        $productColors = [];
        $color = [];
        foreach ($colors as $productColor) {
            if (!in_array("$productColor->desc", $color)) {
                $color[] = $productColor->desc;
                $productColors[] =
                    [
                        'id' => $productColor->id,
                        'color' => $productColor->desc,
                    ];
            }
        }

        $prodSizes = ProductsAttributes::select('product_attributes.id', 'product_attributes.desc')
            ->join('products', 'products.id', '=', 'product_attributes.product_id')
            ->join('subcategories2', 'subcategories2.id', '=', 'products.sub_category_id')
            ->where('subcategories2.slug', $subcategory2->slug)
            ->where('product_attributes.name', 'size')
            ->get();

        $productSizes = [];
        $size = [];
        foreach ($prodSizes as $productSize) {
            if (!in_array("$productSize->desc", $size)) {
                $size[] = $productSize->desc;
                $productSizes[] =
                    [
                        'id' => $productSize->id,
                        'size' => $productSize->desc,
                    ];
            }
        }

        $specialProduct = $this->userManager->getSpecialProduct();
        $mainSliders = SubcategorySlider::select('id', 'main_slider')->where('main_slider', '!=', NULL)->take(5)->get();
        $sidebarSliders = SubcategorySlider::select('id', 'sidebar_slider')->where('sidebar_slider', '!=', NULL)->limit(3)->get();
        $category = Categories::where('slug', $cat)->first();
        $testimonials = Testimonials::select('title', 'desc', 'image')->get();

        $onSellProducts = $this->userManager->getcategorySellProduct();

         $subcategory = SubCategory::where('slug', $subcat)->limit(1)->first();
        return view('front.pages.sub_category2_product', compact('testimonials', 'mainSliders', 'sidebarSliders', 'products', 'category', 'subcategory2', 'subcategory','max', 'min', 'productBrands', 'productColors', 'productSizes', 'specialProduct','onSellProducts'));
    }

    public
    function getQuickView(Request $request)
    {
        $product = Products::find($request->get('productId'));
        if (!$product) {
            abort(404, 'Data not found');
        }
        $productColors = ProductsAttributes::select('id', 'desc')
            ->where('product_id', $product->id)
            ->where('name', 'color')->get();
        return view('front.pages.include.quick_view', compact('product', 'productColors'));
    }

    public
    function getPriceRangeProducts(Request $request)
    {
        $products = [];
        $data = Products::select(DB::raw(" products.*, product_discount.price as discount"))
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->leftJoin('product_discount', 'products.id', '=', 'product_discount.product_id')
            ->where('subcategories.slug', $request->get('slug'))
            ->get();
        foreach ($data as $product) {
            if ($product->discount == null) {
                $data1 = Products::select(DB::raw(" products.*"))
                    ->whereBetween('price', [$request->get('min'), $request->get('max')])
                    ->where('products.id', $product->id)
                    ->first();
                if ($data1) {
                    $products[] = $data1;
                }
            } else {
                $data2 = Products::select(DB::raw(" products.* , product_discount.price as discount"))
                    ->leftJoin('product_discount', 'products.id', '=', 'product_discount.product_id')
                    ->where(function ($query) {
                        $query->where('product_discount.start_date', '<=', date('Y-m-d'))
                            ->orWhere('product_discount.end_date', '>=', date('Y-m-d'));
                    })
                    ->having("discount", "<=", $request->get('max'))
                    ->having("discount", ">", $request->get('min'))
                    ->where('products.id', $product->id)
                    ->orderBy("discount")
                    ->first();
                if ($data2) {
                    $products[] = $data2;
                }
            }
        }
        return view('front.pages.product.filter_products', compact('products'));
    }

    public
    function getBrandProducts(Request $request)
    {
        if (!$request->get('brandId')) {
            $products = Products::select('products.*', 'subcategories.id as subCatId')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->join('brands', 'brands.id', '=', 'products.brand_id')
                ->where('subcategories.slug', $request->get('slug'))
                ->where('products.status', 1)
                ->get();
        } else {
            $id = [];
            foreach ($request->get('brandId') as $brandId) {
                $brand = Brands::find($brandId);
                if ($brand) {
                    $id[] = $brand->id;
                }
            }
            $products = Products::select('products.*', 'subcategories.id as subCatId')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->join('brands', 'brands.id', '=', 'products.brand_id')
                ->where('subcategories.slug', $request->get('slug'))
                ->whereIn('brands.id', $id)
                ->where('products.status', 1)
                ->get();
        }

        return view('front.pages.product.filter_products', compact('products'));
    }

    public
    function getAttributeProducts(Request $request)
    {
        if (!$request->get('attribute')) {
            $products = Products::select('products.*', 'subcategories.id as subCatId')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->join('brands', 'brands.id', '=', 'products.brand_id')
                ->where('subcategories.slug', $request->get('slug'))
                ->where('products.status', 1)
                ->get();
        } else {
            $attributeId = [];
            foreach ($request->get('attribute') as $attrId) {
                $attribute = ProductsAttributes::find($attrId);
                if ($attribute) {
                    $attributeId[] = $attribute->id;
                }
            }

            $productId = Products::select('products.id')
                ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
                ->whereIn('product_attributes.id', $request->get('attribute'))
                ->where('products.status', 1)
                ->groupBy('id')
                ->get();

            $products = Products::select('products.*')
                ->whereIn('products.id', $productId)
                ->get();
        }
        return view('front.pages.product.filter_products', compact('products'));
    }

    public
    function getReviewForm(Request $request)
    {
        $order = Order::where('user_id', Auth::user()->id)->where('product_id', $request->get('productId'))->first();
        if (!$order) {
            return response()->json([
                'error' => true,
                'message' => 'Oops! You are not allowed to review this product.'
            ]);
        }
        $productReview = ProductReview::select('product_review.id', 'product_review.title', 'product_review.desc', 'product_review.rating')
            ->where('user_id', Auth::user()->id)
            ->first();

        return view('front.pages.review_form', compact('order', 'productReview'));
    }

    public
    function postReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|in:1,2,3,4,5',
            'desc' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors(),
            ]);
        }

        $order = Order::where('user_id', Auth::user()->id)->where('product_id', $request->get('productId'))->first();
        if (!$order) {
            return response()->json([
                'error' => true,
                'message' => 'Oops! You are not allowed to review this product.'
            ]);
        }
        if ($request->get('reviewId')) {
            $productReview = ProductReview::find($request->get('reviewId'));
        } else {
            $productReview = new ProductReview();
        }
        $productReview->rating = $request->get('rating');
        $productReview->product_id = $order->product_id;
        $productReview->user_id = Auth::user()->id;
        $productReview->desc = $request->get('desc');
        $productReview->title = $request->get('title');
        $productReview->save();

        Session::flash('success', 'Thank you so much. Your review has been saved.');
        return response()->json([
            'success' => true,
            'message' => 'Thank you so much. Your review has been saved.'
        ]);
    }

    public
    function getProductSuggestion(Request $request)
    {
        $data = $request->get('term', '');

        $products = Products::select('products.name', 'categories.slug as catSlug', 'categories.name as catName')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('products.name', 'LIKE', "%$data%")
            ->get();

        $data = array();
        foreach ($products as $product) {
            $data[] = array('value' => $product->name . ' ' . 'in' . ' ' . $product->catName, 'name' => $product->name, 'slug' => $product->catSlug);
        }
        if (count($data))
            return $data;
        else
            return ['value' => 'No Result Found', 'id' => ''];
    }

    public
    function getProductSearch(Request $request)
    {
        $subId = [];
        if ($request->get('searchcat')) {
            $category = Categories::where('slug', $request->get('searchcat'))->limit(1)->first();
            $subCategories = $category->subCategories()->get();
            foreach ($subCategories as $subCategory) {
                $subId[] = $subCategory->id;
            }
        } elseif ($request->get('category')) {
            $category = Categories::where('slug', $request->get('category'))->limit(1)->first();
            $subCategories = $category->subCategories()->get();
            foreach ($subCategories as $subCategory) {
                $subId[] = $subCategory->id;
            }
        }
        $data = $request->get('search');
        if (!$subId) {
            $products = Products::select('products.*')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->where('products.name', 'LIKE', "%$data%")
                ->where('products.status', 1)
                ->paginate(16);
            $productId = [];

            $products_id = array();
            foreach ($products as $product) {
                $productId[] = $product->price;
                $products_id[] = $product->id;
            }
            if (count($productId) > 0) {
                $max = max($productId);
                $min = min($productId);
            } else {
                $max = 0;
                $min = 0;
            }

            

            $productBrands = Products::select('brands.id as brandId')
                ->join('brands', 'brands.id', '=', 'products.brand_id')
                ->whereIn('products.id', $productId)
                ->groupBy('brandId')
                ->get();

            $productColors = ProductsAttributes::select('product_attributes.desc as color')
                ->join('products', 'products.id', '=', 'product_attributes.product_id')
                ->whereIn('products.id', $productId)
                ->where('product_attributes.name', 'color')
                ->groupBy('color')
                ->get();

            $productSizes = ProductsAttributes::select('product_attributes.desc as size')
                ->join('products', 'products.id', '=', 'product_attributes.product_id')
                ->whereIn('products.id', $productId)
                ->where('product_attributes.name', 'size')
                ->groupBy('size')
                ->get();

            $specialProduct = $this->userManager->getSpecialProduct();

            $sidebarSliders = SubcategorySlider::select('id', 'sidebar_slider')->where('sidebar_slider', '!=', NULL)->limit(3)->get();

            $onSellProducts = $this->userManager->getcategorySellProduct();

            return view('front.pages.search_products', compact('products', 'data', 'min', 'max', 'productBrands', 'productColors', 'productSizes', 'productId','specialProduct','sidebarSliders','onSellProducts','products_id'));
        } else {
            $products = Products::select('products.*')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->where('products.name', 'LIKE', "%$data%")
                ->whereIn('subcategories.id', $subId)
                ->where('products.status', 1)
                ->paginate(16);

            foreach ($products as $product) {
                $productId[] = $product->price;
            }

            $max = max($productId);
            $min = min($productId);

            $productBrands = Brands::select('brands.id as brandId')
                ->join('products', 'products.brand_id', '=', 'brands.id')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->whereIn('subcategories.id', $subId)
                ->groupBy('brandId')
                ->get();

            $productColors = ProductsAttributes::select('product_attributes.desc as color')
            // $productColors = ProductsAttributes::select(DB::raw("product_attributes.desc as color,product_attributes.id"))
                ->join('products', 'products.id', '=', 'product_attributes.product_id')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->whereIn('subcategories.id', $subId)
                ->where('product_attributes.name', 'color')
                ->groupBy('color')
                ->get();

            $productSizes = ProductsAttributes::select('product_attributes.desc as size')
            // $productSizes = ProductsAttributes::select(DB::raw("product_attributes.desc as size,product_attributes.id"))
                ->join('products', 'products.id', '=', 'product_attributes.product_id')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->whereIn('subcategories.id', $subId)
                ->where('product_attributes.name', 'size')
                ->groupBy('size')
                ->get();


            $specialProduct = $this->userManager->getSpecialProduct();

            $sidebarSliders = SubcategorySlider::select('id', 'sidebar_slider')->where('sidebar_slider', '!=', NULL)->limit(3)->get();

            $onSellProducts = $this->userManager->getcategorySellProduct();

            return view('front.pages.search_products', compact('products', 'data', 'min', 'max', 'productBrands', 'productColors', 'productSizes', 'subId','specialProduct','sidebarSliders','onSellProducts','productId'));
        }
    }

    public function getPriceProductsSearchForm(Request $request)
    {
        // return $request->all();
        $search = $request['search'];
        $products = [];
        $data = Products::select(DB::raw(" products.*, product_discount.price as discount, product_discount.status as discount_status"))
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->leftJoin('product_discount', 'products.id', '=', 'product_discount.product_id')
            ->where('products.name', 'LIKE', "%$search%")
            ->where('products.status', 1)
            ->get();

        foreach ($data as $product) {
            if ($product->discount == null) {
                $data1 = Products::select(DB::raw(" products.*"))
                    ->whereBetween('price', [$request->get('min'), $request->get('max')])
                    ->where('products.id', $product->id)
                    ->first();
                if ($data1) {
                    $products[] = $data1;
                }
            } else {
                if($product->discount_status == 1)
                {
                    $data2 = Products::select(DB::raw(" products.* , product_discount.price as discount"))
                    ->leftJoin('product_discount', 'products.id', '=', 'product_discount.product_id')
                    ->where(function ($query) {
                        $query->where('product_discount.start_date', '<=', date('Y-m-d'))
                            ->orWhere('product_discount.end_date', '>=', date('Y-m-d'));
                    })
                    ->having("discount", "<=", $request->get('max'))
                    ->having("discount", ">", $request->get('min'))
                    ->where('products.id', $product->id)
                    ->orderBy("discount")
                    ->first();
                    if ($data2) {
                        $products[] = $data2;
                    }
                }
                else
                {
                    $data3 = Products::select(DB::raw(" products.*"))
                        ->whereBetween('price', [$request->get('min'), $request->get('max')])
                        ->where('products.id', $product->id)
                        ->first();
                    if ($data3) {
                        $products[] = $data3;
                    }
                }
                
            }
        }
        return view('front.pages.product.filter_products', compact('products'));

    }

    public function getBrandProductsSearchForm(Request $request)
    {
        // return $request['brandId'];

        $search = $request['search'];
        $products = [];
        $products = Products::select(DB::raw(" products.*, product_discount.price as discount, product_discount.status as discount_status"))
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->leftJoin('product_discount', 'products.id', '=', 'product_discount.product_id')
            ->where('products.name', 'LIKE', "%$search%")
            ->where('products.status', 1)
            ->whereIn('products.brand_id', $request['brandId'])
            ->get();

        return view('front.pages.product.filter_products', compact('products'));
    }

    public function getAttributeProductsSearchForm(Request $request)
    {
        // return $request->all();

        $attributeId = [];
        foreach ($request->get('attribute') as $attrId) {
            $attributes = ProductsAttributes::where('desc','=',$attrId)->get();
            foreach ($attributes as $key => $attribute_get) {
                if ($attribute_get) {
                    $attributeId[] = $attribute_get->id;
                } 
            } 
        }

        // return $attributeId;

        $search = $request['search'];
        $productId = Products::select('products.id')
                ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
                ->whereIn('product_attributes.id', $attributeId)
                ->where('products.status', 1)
                ->groupBy('id')
                ->get();

        $products = Products::select('products.*')
            ->where('products.name', 'LIKE', "%$search%")
            ->whereIn('products.id', $productId)
            ->get();

        return view('front.pages.product.filter_products', compact('products'));
    }

    public
    function getBrandProductsFromSearch(Request $request)
    {
        $id = [];
        foreach ($request->get('brandId') as $brandId) {
            $brand = Brands::find($brandId);
            if ($brand) {
                $id[] = $brand->id;
            }
        }
        if ($request->get('subId')) {
            $products = Products::select('products.*', 'subcategories.id as subCatId')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->join('brands', 'brands.id', '=', 'products.brand_id')
                ->whereIn('subcategories.id', $request->get('subId'))
                ->where('brand.id', $id)
                ->where('products.status', 1)
                ->get();
        } else {
            $products = Products::select('products.*', 'subcategories.id as subCatId')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->join('brands', 'brands.id', '=', 'products.brand_id')
                ->whereIn('products.id', $request->get('productId'))
                ->where('brand.id', $id)
                ->where('products.status', 1)
                ->get();
        }
        return view('front.pages.product.filter_products', compact('products'));
    }

    public
    function getPriceProductsFromSearch(Request $request)
    {
        if ($request->get('subId')) {
            $products = Products::select('products.*', 'subcategories.id as subCatId', 'wishlist.id as wishlistId')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->whereIn('products.id', $request->get('productId'))
                ->where('products.price', '<=', $request->get('min'))
                ->where('products.price', '>=', $request->get('max'))
                ->where('products.status', 1)
                ->get();
        } else {
            $products = Products::select('products.*', 'subcategories.id as subCatId', 'wishlist.id as wishlistId')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->leftJoin('wishlist', 'wishlist.product_id', 'products.id')
                ->whereIn('products.id', $request->get('productId'))
                ->where('products.price', '<=', $request->get('min'))
                ->where('products.price', '>=', $request->get('max'))
                ->where('products.status', 1)
                ->get();
        }
        return view('front.pages.product.filter_products', compact('products'));
    }

    public function getYourOrders()
    {
        $rechargeOrders = RechargeHistory::select('recharge_history.recharge_num', 'recharge_history.status', 'recharge_history.amount', 'recharge_history.transaction_id', 'operators.name as operator')
            ->join('operators', 'operators.id', 'recharge_history.operator_id')
            ->where('recharge_history.user_id', Auth::user()->id)
            ->orderBy('recharge_history.id', 'DESC')
            ->paginate(10);
        $productOrders = Order::select('products.name', 'order.price','products.product_img', 'order.status', 'order.quantity', 'order.shipping_method', 'order.transaction_id', 'order.created_at')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->where('order.user_id', Auth::user()->id)
            ->orderBy('order.id', 'DESC')
            ->paginate(10);
        $walletOrders = WalletHistory::select('amount', 'transaction_id', 'tran_type', 'tran_type', 'status')
            ->where('wallet_history.user_id', Auth::user()->id)
            ->orderBy('wallet_history.id', 'DESC')
            ->paginate(10);

        return view('front.pages.order.your_orders', compact('rechargeOrders', 'productOrders', 'walletOrders'));
    }

    public function getYourRechargeOrderDetails($orderId)
    {
        $order = RechargeHistory::select('recharge_history.recharge_num', 'recharge_history.status', 'recharge_history.amount', 'recharge_history.transaction_id', 'operators.name as operator')
            ->join('operators', 'operators.id', 'recharge_history.operator_id')
            ->where('transaction_id', $orderId)->limit(1)->first();

        if (!$order) {
            Session::flash('error', 'Order not found..!');
        }
        $pdf = \PDF::loadView('front.pages.invoice.recharge_invoice', compact('order'));
        return $pdf->download('invoice_' . $orderId . '.pdf');
//        return view('front.pages.invoice.recharge_invoice', compact('order'));
    }

    public function getYourOrderDetails($transId)
    {
        $address = ShippingAddress::where('user_id', Auth::user()->id)->where('status', 1)->limit(1)->first();

        $productOrder = Order::select('products.name', 'products.product_img', 'products.slug', 'users.username','users.email', 'order.id', 'order.price', 'order.color', 'order.size', 'order.status', 'order.shipping', 'order.delivery_date', 'order.quantity', 'order.shipping_method', 'order.created_at', 'order.updated_at', 'order.transaction_id')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->where('order.transaction_id', $transId)
            ->limit(1)->first();

        return view('front.pages.order.product_order_details', compact('productOrder', 'address'));
    }

    public function getCancelItemForm(Request $request)
    {
        $productOrder = Order::select('products.name', 'products.product_img', 'products.slug', 'users.username', 'order.id', 'order.price', 'order.color', 'order.size', 'order.status', 'order.shipping', 'order.delivery_date', 'order.quantity', 'order.shipping_method', 'order.created_at', 'order.updated_at', 'order.transaction_id')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->where('order.transaction_id', $request->get('transId'))
            ->limit(1)->first();
        if (!$productOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found..!'
            ]);
        }
        return view('front.pages.order.order_cancel', compact('productOrder'));
    }

    public function postOrderCancel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reasonList' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors(),
            ]);
        }
        $productOrder = Order::select('products.name', 'products.product_img', 'products.slug', 'users.username', 'users.id as sellerId', 'order.id', 'order.price', 'order.color', 'order.size', 'order.status', 'order.shipping', 'order.delivery_date', 'order.quantity', 'order.shipping_method', 'order.created_at', 'order.updated_at', 'order.transaction_id', 'order.user_id')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->where('order.transaction_id', $request->get('transId'))
            ->limit(1)
            ->first();
        if (!$productOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found..!'
            ]);
        }
        $productOrder->status = Order::CANCELED;
        $productOrder->reason = $request->get('reasonList');
        if ($request->get('comments')) {
            $productOrder->comments = $request->get('comments');
        }
        $productOrder->save();
        $user = User::find($productOrder->user_id);
        $seller = User::find($productOrder->sellerId);
        $data = array('username' => $user->username, 'comments' => $request->get('comments'), 'reason' => $request->get('reasonList'), 'seller' => $seller->username, 'status' => $productOrder->status, 'name' => $productOrder->name, 'product_img' => $productOrder->product_img, 'price' => $productOrder->price, 'color' => $productOrder->color, 'size' => $productOrder->size, 'quantity' => $productOrder->quantity, 'transaction_id' => $productOrder->transaction_id);
        $this->mailService->sendOrderCancelMail($data, $user);
        $this->mailService->sendOrderCancelSellerMail($data, $user, $seller->email);

        Session::flash('success', 'We have received your cancellation request..!');
        return response()->json([
            'success' => true,
        ]);

    }

    //Changes by me 02-08-2018 start
    public function postOrderReturn(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'reasonList' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors(),
            ]);
        }
        $productOrder = Order::select('products.name', 'products.product_img', 'products.slug', 'users.username', 'users.id as sellerId', 'order.id', 'order.price', 'order.color', 'order.size', 'order.status', 'order.shipping', 'order.delivery_date', 'order.quantity', 'order.shipping_method', 'order.created_at', 'order.updated_at', 'order.transaction_id', 'order.user_id')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->where('order.transaction_id', $request->get('transId'))
            ->limit(1)
            ->first();
        if (!$productOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found..!'
            ]);
        }
        $productOrder->status = Order::RETURNED;
        $productOrder->reason = $request->get('reasonList');
        if ($request->get('comments')) {
            $productOrder->comments = $request->get('comments');
        }
        $productOrder->save();
        $user = User::find($productOrder->user_id);
        $seller = User::find($productOrder->sellerId);
        $data = array('username' => $user->username, 'comments' => $request->get('comments'), 'reason' => $request->get('reasonList'), 'seller' => $seller->username, 'status' => $productOrder->status, 'name' => $productOrder->name, 'product_img' => $productOrder->product_img, 'price' => $productOrder->price, 'color' => $productOrder->color, 'size' => $productOrder->size, 'quantity' => $productOrder->quantity, 'transaction_id' => $productOrder->transaction_id);
        $this->mailService->sendOrderReturnMail($data, $user);
        $this->mailService->sendOrderReturnSellerMail($data, $user, $seller->email);

        Session::flash('success', 'We have received your cancellation request..!');
        return response()->json([
            'success' => true,
        ]);

    }

    public function getReturnItemForm(Request $request)
    {
        $productOrder = Order::select('products.name', 'products.product_img', 'products.slug', 'users.username', 'order.id', 'order.price', 'order.color', 'order.size', 'order.status', 'order.shipping', 'order.delivery_date', 'order.quantity', 'order.shipping_method', 'order.created_at', 'order.updated_at', 'order.transaction_id')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->where('order.transaction_id', $request->get('transId'))
            ->limit(1)->first();
        if (!$productOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found..!'
            ]);
        }
        return view('front.pages.order.return_order', compact('productOrder'));
    }
    //Changes by me 02-08-2018 over


    public function getProductInvoice($transId)
    {
        $productOrder = Order::select('order.user_id', 'products.name', 'products.desc', 'products.product_img', 'products.slug', 'users.username', 'order.id', 'order.price', 'order.color', 'order.size', 'order.status', 'order.shipping', 'order.delivery_date', 'order.quantity', 'order.shipping_method', 'order.created_at', 'order.transaction_id')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->where('order.transaction_id', $transId)
            ->limit(1)->first();
        if (!$productOrder) {
            return abort(404, 'Data not found');
        }
        return view('front.pages.invoice.product_invoice', compact('productOrder'));
    }

    public function getProductDetail2($slug,$colorid)
    {

        $slideimages = ColorsImages::select('*')->where('attribute_id',$colorid)->first();

        $product = Products::select('products.id', 'products.name', 'products.product_img', 'products.price', 'products.slug', 'products.quantity', 'products.desc', 'products.video_id', 'products.url', 'products.video_thumb', 'subcategories.id as subId', 'subcategories.name as subCatName', 'subcategories2.name as subCatName2', 'categories.name as CatName', 'users.username')
            ->join('subcategories2', 'subcategories2.id', '=', 'products.sub_category_id')
            ->join('subcategories', 'subcategories.id', '=', 'subcategories2.subcategory_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->where('products.slug', $slug)
            ->limit(1)
            ->first();

        $productReviews = $this->userManager->getProductReviewsBYId($product->id);

        $similarProducts = $this->userManager->getSimilarProducts($product);

        $bestThreeSellerProducts = $this->userManager->getBestThreeSellerProducts();
        $bestSellerProducts = $this->userManager->getBestSellerProducts($bestThreeSellerProducts);

        $onSellProducts = $this->userManager->getSellProducts($product->id);

        $categories = Categories::select('id', 'name', 'slug')->get();

        $productColors = ProductsAttributes::select('product_attributes.id', 'product_attributes.desc','colors_images.image1','product_attributes.product_price')->join('colors_images','colors_images.attribute_id','product_attributes.id')->where('product_attributes.product_id', $product->id)->where('name', 'color')->orderBy('desc')->get();

        $productSizes = ProductsAttributes::select('id', 'desc')->where('product_id', $product->id)->where('name', 'size')->get();

        $mainSliders = ProductsSliders::select('id', 'main_slider', 'url')->where('main_slider', '!=', NULL)->take(3)->get();
        $sidebarSlider = ProductsSliders::select('id', 'sidebar_slider', 'url')->where('sidebar_slider', '!=', NULL)->first();
        $products = [];
        $maxelements = 5;
        
        if (Session::has('recentviews')) {
            $pro = stripslashes(Session::get('recentviews'));
            $recentProductsId = json_decode($pro, true);
            if (!in_array($product->id, $recentProductsId)) {
                array_push($recentProductsId, $product->id);
                $products = $recentProductsId;
            } else {
                $products = $recentProductsId;
            }
            $json = json_encode($products);
        } else {
            $products[] = $product->id;
            $json = json_encode($products);
        }
        Session::put('recentviews', $json);
        // Session(['recentviews', $json]);
        

        if (Session::has('recentviews')) {
            $cookie = Session::get('recentviews');
            $pro = stripslashes($cookie);
            $recentProductsId = json_decode($pro, true);
            if (count($recentProductsId) > $maxelements) {//check the number of array elements
                $recentProductsId = array_slice($recentProductsId, 1); // remove the first element if we have 5 already
            }
        }
        if (isset($recentProductsId)) {
            $recentViewsProducts = Products::select(DB::raw(" products.* , (((products.price - product_discount.price) / products.price)  * 100) as percentage"))
                ->leftJoin('product_discount', 'products.id', '=', 'product_discount.product_id')
                ->whereIn('products.id', $recentProductsId)
                ->get();
        }

        $productPrice = ProductsAttributes::select('product_price')->where('id', $colorid)->first();

//         $players = Round::distinct()->where('round_id', $currentgame)->get(['steamid']);
// $players = Round::select('steamid')->where('round_id', $currentgame)->distinct()->get();

        $productSizesColors = ProductsAttributes::select('*')->where('product_id', $product->id)->where('name', 'size_color')->distinct()->get(['desc']);

        $getsize_color = ProductsAttributes::select('*')->where('id',$colorid)->first();

        $color_sizes = ProductsAttributes::select('id','desc2','product_price')->where('desc',$getsize_color->desc)->where('product_id',$product->id)->get();

        

        return view('front.pages.product_detail', compact('sidebarSlider', 'mainSliders', 'product', 'recentViewsProducts', 'categories', 'productColors', 'onSellProducts', 'productSizes', 'similarProducts', 'productReviews', 'bestSellerProducts', 'bestThreeSellerProducts','slideimages','productPrice','productSizesColors','color_sizes'));
    }
}
