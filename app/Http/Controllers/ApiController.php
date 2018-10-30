<?php

namespace App\Http\Controllers;

use App\Classes\WalletManager;
use App\FAQ;
use App\Model\AboutUs;
use App\Model\Brands;
use App\Model\CancellationPolicy;
use App\Model\DeliveryInfo;
use App\Model\SellerPolicy;
use App\Model\Testimonials;
use App\TermsCondition;
use Carbon\Carbon;
use App\Classes\ApiManager;
use App\Classes\MailService;
use App\Classes\RechargeManager;
use App\Classes\UserManager;
use App\Model\Cart;
use App\Model\Categories;
use App\Model\Circle;
use App\Model\City;
use App\Model\HomepageSlider;
use App\Model\Operators;
use App\Model\Order;
use App\Model\ProductReview;
use App\Model\Products;
use App\Model\ProductsAttributes;
use App\Model\RechargeHistory;
use App\Model\Role;
use App\Model\Services;
use App\Model\ShippingAddress;
use App\Model\States;
use App\Model\SubCategory;
use App\Model\User;
use App\Model\WalletHistory;
use App\Model\Wishlist;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;
use App\Model\ShippingHistory;
//use App\Http\Controllers\Carbon;

class ApiController extends Controller
{
    public $successStatus = 200;

    /**
     * @var ApiManager
     */
    private $apiManager;
    /**
     * @var UserManager
     */
    private $userManager;
    /**
     * @var RechargeManager
     */
    private $rechargeManager;
    /**
     * @var MailService
     */
    private $mailService;
    /**
     * @var WalletManager
     */
    private $walletManager;

    public function __construct(ApiManager $apiManager, UserManager $userManager, RechargeManager $rechargeManager, MailService $mailService, WalletManager $walletManager)
    {
        $this->apiManager = $apiManager;
        $this->userManager = $userManager;
        $this->rechargeManager = $rechargeManager;
        $this->mailService = $mailService;
        $this->walletManager = $walletManager;
    }

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $user = User::where('mobile_num', $request->get('mobile_num'))->limit(1)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Mobile number not found..!'
            ]);
        }
        if ($user->is_verify != 1) {
            return response()->json([
                'success' => false,
                'message' => 'Mobile number not verified..!'
            ]);
        }

        $result = $this->apiManager->sendOtp($user);
        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'OTP not send'
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'OTP send successfully'
        ]);
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email',
            'mobile_num' => 'required|regex:/[0-9]{10}/|digits:10|unique:users,mobile_num',
        ]);

        if ($validator->fails()) {
            //return response()->json(['error' => $validator->errors()], 401);
            return response()->json(['success' => false,'message' => 'Email OR Mobile is already Used!!!']);
        }

        $user = new User();
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->mobile_num = $request->get('mobile_num');
        $user->otp = rand(100000, 999999);
        $user->save();

        $result = $this->apiManager->sendOtp($user);
        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'OTP not send'
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'OTP send successfully'
        ]);
    }

    public function getVerifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'otp' => 'required',
            'mobile_num' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Something missing',
            ]);
        }
        $user = User::where('mobile_num', $request->get('mobile_num'))->where('otp', $request->get('otp'))->limit(1)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Otp..!'
            ]);
        }
        if ($request->get('status') == 'registered') {
            $user->is_verify = 1;
            $user->otp = NULL;
            $user->save();
        }
        return response()->json([
            'success' => true,
            'message' => 'User login successfully..',
            'data' => $user
        ]);
    }

    public function getResendOtp(Request $request)
    {
        $user = User::where('mobile_num', $request->get('mobile_num'))->limit(1)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Mobile number not found..!'
            ]);
        }
        $result = $this->apiManager->sendOtp($user);
        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'OTP not send'
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'OTP send successfully'
        ]);
    }

    public function getProducts(Request $request)
    {
        if ($request->get('limit')) {
            $limitProducts = $this->apiManager->getLimitProducts($request->get('limit'));
        } else {
            $limitProducts = $this->apiManager->getProducts();
        }
        if (count($limitProducts) > 0) {
            $products = [];
            foreach ($limitProducts as $product) {
                $products[] =
                    [
                        'id' => $product->id,
                        'name' => $product->name,
                        'product_img' => env('APP_URL') . '/268ProductImg/' . $product->product_img,
                        'price' => $product->price,
                        'discount' => ($product->discount == NULL) ? 0 : $product->discount,
                    ];
            }
            return response()->json([
                'status' => true,
                'message' => 'Successfully fetched',
                'data' => $products
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Products not found',
            ]);
        }
    }

    public function getProductDetails(Request $request)
    {
        $product = $this->apiManager->getProductById($request->get('productId'));
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ]);
        }

        $user = User::find($request->get('userId'));
        if ($user) {
            $wishlist = Wishlist::where('product_id', $product->id)->where('user_id', $user->id)->first();
            $count = Cart::where('user_id', $user->id)->count();
            if ($wishlist) {
                $wishlisted = true;
            } else {
                $wishlisted = false;
            }
        } else {
            $wishlisted = false;
            $count = 0;
        }

        $productColors = ProductsAttributes::select('id', 'desc')->where('product_id', $product->id)->where('name', 'color')->get();
        $colors = [];
        foreach ($productColors as $productColor) {
            $colors[] = $productColor->desc;
        }
        $color = $this->userManager->to_string($colors);
        $productSizes = ProductsAttributes::select('id', 'desc')->where('product_id', $product->id)->where('name', 'size')->get();
        $size = [];
        foreach ($productSizes as $productSize) {
            $size[] = $productSize->desc;
        }
        $str = $this->userManager->to_string($size);

        $screenshots = $product->productScreenshots()->get();
        $productReviews = $this->userManager->getProductReviewsBYId($product->id);
        $rating = $product->getAvgRating();
        $discount = $product->getDiscountPrice();
        $attribute = $product->ProductAttributes()->where('name', '!=', 'color')->where('name', '!=', 'size')->select('name', 'desc')->get();
        if ($product->size_chart) {
            $sizeChart = env('APP_URL') . '/sizechart/' . $product->size_chart;
        } else {
            $sizeChart = '';
        }

        $productDetail =
            [
                'id' => $product->id,
                'name' => $product->name,
                'product_img' => env('APP_URL') . '/850ProductImg/' . $product->product_img,
                'size_chart' => $sizeChart,
                'price' => $product->price,
                'discount' => ($discount == NULL) ? 0 : $discount,
                'slug' => $product->slug,
                'quantity' => $product->quantity,
                'desc' => $product->desc,
                'subId' => $product->subId,
                'subCatName' => $product->subCatName,
                'CatName' => $product->CatName,
                'seller' => $product->username,
                'rating' => $rating,
                'wishlist' => $wishlisted,
            ];

        $screen = [];
        foreach ($screenshots as $screenshot) {
            $screen[] =
                [
                    'id' => $screenshot->id,
                    'product_id' => $screenshot->product_id,
                    'screenshots' => env('APP_URL') . '/850ProductImg/' . $screenshot->screenshots,
                ];
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully fetched',
            'cart' => $count,
            'productDetail' => $productDetail,
            'productReviews' => $productReviews,
            'screenshots' => $screen,
            'productSizes' => $str,
            'productColors' => $color,
            'attribute' => $attribute,
        ]);
    }

    function postReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|in:1,2,3,4,5',
            'desc' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ]);
        }

        $user = User::find($request->get('userId'));
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ]);
        }
        $product = Products::find($request->get('productId'));
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ]);
        }

        $order = Order::where('user_id', $user->id)->where('product_id', $request->get('productId'))->first();
        if (!$order) {
            return response()->json([
                'success' => false,
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
        $productReview->user_id = $user->id;
        $productReview->desc = $request->get('desc');
        if ($request->get('title')) {
            $productReview->title = $request->get('title');
        }
        $productReview->save();

        return response()->json([
            'success' => true,
            'message' => 'Thank you so much. Your review has been saved.'
        ]);
    }

    public function getCategories()
    {
        $categories = Categories::select('id', 'name', 'cat_img', 'slug')->get();
        if (count($categories) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Category not fetched',

            ]);
        }
        $data = [];
        foreach ($categories as $category) {
            if ($category->cat_img) {
                $image = env('APP_URL') . '/category/' . $category->cat_img;
            } else {
                $image = '';
            }
            $data[] =
                [
                    'id' => $category->id,
                    'name' => $category->name,
                    'cat_img' => $image,
                    'slug' => $category->slug,
                ];
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully fetched',
            'data' => $data,

        ]);
    }

    public function getSubcategories(Request $request)
    {
        $category = Categories::find($request->get('catId'));
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'category not found',

            ]);
        }
        $subcategories = $category->subCategories()->select('id', 'category_id', 'sub_cat_img', 'name', 'slug')->get();
        if (count($subcategories) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Subcategory not fetched',

            ]);
        }
        $data = [];
        foreach ($subcategories as $subcategory) {
            if ($category->cat_img) {
                $image = env('APP_URL') . '/category/' . $category->cat_img;
            } else {
                $image = '';
            }
            $data[] =
                [
                    'id' => $subcategory->id,
                    'name' => $subcategory->name,
                    'category_id' => $subcategory->category_id,
                    'sub_cat_img' => $image,
                    'slug' => $subcategory->slug,
                ];
        }

        return response()->json([
            'success' => true,
            'message' => 'Successfully fetched',
            'data' => $data,

        ]);
    }

    public function getSubcategoryProducts(Request $request)
    {
        DB::beginTransaction();
        try {
            if (!SubCategory::find($request->get('sub_cat_id'))) {
                return response()->json([
                    'success' => false,
                    'message' => 'Subcategory not found !'
                ]);
            }
            $subcategory = SubCategory::find($request->get('sub_cat_id'));
            
            $products = $this->apiManager->getSubcategoryProducts($subcategory->id);
            //print_r($products);exit;
            if (count($products) > 0) {
                $dataArray = [];
                foreach ($products as $product) {
                    $user = User::find($request->get('userId'));
                    if ($user) {
                        $wishlist = Wishlist::where('product_id', $product->id)->where('user_id', $user->id)->first();
                        if ($wishlist) {
                            $wishlisted = true;
                        } else {
                            $wishlisted = false;
                        }
                    } else {
                        $wishlisted = false;
                    }
                    $discount = $product->getDiscountPrice();
                    $dataArray[] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'product_img' => env('APP_URL') . '/268ProductImg/' . $product->product_img,
                        'price' => $product->price,
                        'discount' => ($discount == NULL) ? 0 : $discount,
                        'wishlist' => $wishlisted,
                    ];
                }
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Successfully fetch !',
                    'data' => $dataArray
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Products not found!'
                ]);
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

    public function getNewArrivalsProducts(Request $request)
    {
        $newArrivalsProducts = $this->userManager->getNewArrivalsProducts();
        if (count($newArrivalsProducts) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Products not fetch'
            ]);
        }
        $dataArray = [];
        foreach ($newArrivalsProducts as $product) {
            $user = User::find($request->get('userId'));
            if ($user) {
                $wishlist = Wishlist::where('product_id', $product->id)->where('user_id', $user->id)->first();
                if ($wishlist) {
                    $wishlisted = true;
                } else {
                    $wishlisted = false;
                }
            } else {
                $wishlisted = false;
            }
            $discount = $product->getDiscountPrice();
            $dataArray[] = [
                'id' => $product->id,
                'name' => $product->name,
                'product_img' => env('APP_URL') . '/268ProductImg/' . $product->product_img,
                'price' => $product->price,
                'discount' => ($discount == NULL) ? 0 : $discount,
                'wishlist' => $wishlisted
            ];
        }


        return response()->json([
            'success' => true,
            'message' => 'Successfully fetch !',
            'data' => $dataArray
        ]);
    }

    public function getTopSellerProducts(Request $request)
    {
        $topSellerProducts = $this->userManager->getTopSellerProducts();
        if (count($topSellerProducts) == 0) {
            return response()->json([
                'success' => true,
                'message' => 'Products not fetch'
            ]);
        }
        $dataArray = [];
        foreach ($topSellerProducts as $product) {
            $user = User::find($request->get('userId'));
            if ($user) {
                $wishlist = Wishlist::where('product_id', $product->id)->where('user_id', $user->id)->first();
                if ($wishlist) {
                    $wishlisted = true;
                } else {
                    $wishlisted = false;
                }
            } else {
                $wishlisted = false;
            }
            $discount = $product->getDiscountPrice();
            $dataArray[] = [
                'id' => $product->id,
                'name' => $product->name,
                'product_img' => env('APP_URL') . '/268ProductImg/' . $product->product_img,
                'price' => $product->price,
                'discount' => ($discount == NULL) ? 0 : $discount,
                'wishlist' => $wishlisted
            ];
        }
        return response()->json([
            'success' => true,
            'message' => 'Successfully fetch !',
            'data' => $dataArray
        ]);
    }

    public function getSpecialProducts(Request $request)
    {
        $specialProducts = $this->userManager->getSpecialProducts();
        if (count($specialProducts) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Products not fetch'
            ]);
        }
        $dataArray = [];
        foreach ($specialProducts as $product) {
            $user = User::find($request->get('userId'));
            if ($user) {
                $wishlist = Wishlist::where('product_id', $product->id)->where('user_id', $user->id)->first();
                if ($wishlist) {
                    $wishlisted = true;
                } else {
                    $wishlisted = false;
                }
            } else {
                $wishlisted = false;
            }
            $discount = $product->getDiscountPrice();
            $dataArray[] = [
                'id' => $product->id,
                'name' => $product->name,
                'product_img' => env('APP_URL') . '/268ProductImg/' . $product->product_img,
                'price' => $product->price,
                'discount' => ($discount == NULL) ? 0 : $discount,
                'wishlist' => $wishlisted
            ];
        }
        return response()->json([
            'success' => true,
            'message' => 'Successfully fetch !',
            'data' => $dataArray
        ]);
    }

    public function getRecommendProducts(Request $request)
    {
        $recommendProducts = $this->userManager->getRecommendProducts();
        if (count($recommendProducts) == 0) {
            return response()->json([
                'success' => true,
                'message' => 'Products not fetch'
            ]);
        }
        $dataArray = [];
        foreach ($recommendProducts as $product) {
            $user = User::find($request->get('userId'));
            if ($user) {
                $wishlist = Wishlist::where('product_id', $product->id)->where('user_id', $user->id)->first();
                if ($wishlist) {
                    $wishlisted = true;
                } else {
                    $wishlisted = false;
                }
            } else {
                $wishlisted = false;
            }
            $discount = $product->getDiscountPrice();
            $dataArray[] = [
                'id' => $product->id,
                'name' => $product->name,
                'product_img' => env('APP_URL') . '/268ProductImg/' . $product->product_img,
                'price' => $product->price,
                'discount' => ($discount == NULL) ? 0 : $discount,
                'wishlist' => $wishlisted
            ];
        }
        return response()->json([
            'success' => true,
            'message' => 'Successfully fetch !',
            'data' => $dataArray
        ]);
    }

    public function getUpTo40DiscountsProducts(Request $request)
    {
        $upTo40Discounts = $this->userManager->getDiscountProducts('1', '40');
        if (count($upTo40Discounts) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Products not fetch'
            ]);
        }
        $dataArray = [];
        foreach ($upTo40Discounts as $product) {
            $user = User::find($request->get('userId'));
            if ($user) {
                $wishlist = Wishlist::where('product_id', $product->id)->where('user_id', $user->id)->first();
                if ($wishlist) {
                    $wishlisted = true;
                } else {
                    $wishlisted = false;
                }
            } else {
                $wishlisted = false;
            }
            $dataArray[] = [
                'id' => $product->id,
                'name' => $product->name,
                'product_img' => env('APP_URL') . '/268ProductImg/' . $product->product_img,
                'price' => $product->price,
                'discount' => ($product->discount == NULL) ? 0 : $product->discount,
                'wishlist' => $wishlisted
            ];
        }
        return response()->json([
            'success' => true,
            'message' => 'Successfully fetch !',
            'data' => $dataArray
        ]);
    }

    public function getUpTo50DiscountsProducts(Request $request)
    {
        $upTo50Discounts = $this->userManager->getDiscountProducts('41', '50');
        if (count($upTo50Discounts) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Products not fetch'
            ]);
        }
        $dataArray = [];
        foreach ($upTo50Discounts as $product) {
            $user = User::find($request->get('userId'));
            if ($user) {
                $wishlist = Wishlist::where('product_id', $product->id)->where('user_id', $user->id)->first();
                if ($wishlist) {
                    $wishlisted = true;
                } else {
                    $wishlisted = false;
                }
            } else {
                $wishlisted = false;
            }
            $dataArray[] = [
                'id' => $product->id,
                'name' => $product->name,
                'product_img' => env('APP_URL') . '/268ProductImg/' . $product->product_img,
                'price' => $product->price,
                'discount' => ($product->discount == NULL) ? 0 : $product->discount,
                'wishlist' => $wishlisted
            ];
        }
        return response()->json([
            'success' => true,
            'message' => 'Successfully fetch !',
            'data' => $dataArray
        ]);
    }

    public function getUpTo60DiscountsProducts(Request $request)
    {
        $upTo60Discounts = $this->userManager->getDiscountProducts('51', '60');
        if (count($upTo60Discounts) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Products not fetch'
            ]);
        }
        $dataArray = [];
        foreach ($upTo60Discounts as $product) {
            $user = User::find($request->get('userId'));
            if ($user) {
                $wishlist = Wishlist::where('product_id', $product->id)->where('user_id', $user->id)->first();
                if ($wishlist) {
                    $wishlisted = true;
                } else {
                    $wishlisted = false;
                }
            } else {
                $wishlisted = false;
            }
            $dataArray[] = [
                'id' => $product->id,
                'name' => $product->name,
                'product_img' => env('APP_URL') . '/268ProductImg/' . $product->product_img,
                'price' => $product->price,
                'discount' => ($product->discount == NULL) ? 0 : $product->discount,
                'wishlist' => $wishlisted
            ];
        }
        return response()->json([
            'success' => true,
            'message' => 'Successfully fetch !',
            'data' => $dataArray
        ]);
    }

    public function getUpTo70DiscountsProducts(Request $request)
    {
        $upTo70Discounts = $this->userManager->getDiscountProducts('61', '70');
        if (count($upTo70Discounts) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Products not fetch'
            ]);
        }
        $dataArray = [];
        foreach ($upTo70Discounts as $product) {
            $user = User::find($request->get('userId'));
            if ($user) {
                $wishlist = Wishlist::where('product_id', $product->id)->where('user_id', $user->id)->first();
                if ($wishlist) {
                    $wishlisted = true;
                } else {
                    $wishlisted = false;
                }
            } else {
                $wishlisted = false;
            }
            $dataArray[] = [
                'id' => $product->id,
                'name' => $product->name,
                'product_img' => env('APP_URL') . '/268ProductImg/' . $product->product_img,
                'price' => $product->price,
                'discount' => ($product->discount == NULL) ? 0 : $product->discount,
                'wishlist' => $wishlisted
            ];
        }
        return response()->json([
            'success' => true,
            'message' => 'Successfully fetch !',
            'data' => $dataArray
        ]);
    }

    public function getUpTo80DiscountsProducts(Request $request)
    {
        $upTo80Discounts = $this->userManager->getDiscountProducts('71', '80');
        if (count($upTo80Discounts) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Products not fetch'
            ]);
        }
        $dataArray = [];
        foreach ($upTo80Discounts as $product) {
            $user = User::find($request->get('userId'));
            if ($user) {
                $wishlist = Wishlist::where('product_id', $product->id)->where('user_id', $user->id)->first();
                if ($wishlist) {
                    $wishlisted = true;
                } else {
                    $wishlisted = false;
                }
            } else {
                $wishlisted = false;
            }
            $dataArray[] = [
                'id' => $product->id,
                'name' => $product->name,
                'product_img' => env('APP_URL') . '/268ProductImg/' . $product->product_img,
                'price' => $product->price,
                'discount' => ($product->discount == NULL) ? 0 : $product->discount,
                'wishlist' => $wishlisted
            ];
        }
        return response()->json([
            'success' => true,
            'message' => 'Successfully fetch !',
            'data' => $dataArray
        ]);
    }

    public function getHomepageSliders()
    {
        $smallSlider1 = HomepageSlider::select('id', 'main_slider')->where('main_slider', '!=', NULL)->limit(1)->first();
        $smallSlider2 = HomepageSlider::select('id', 'main_slider')->where('main_slider', '!=', NULL)->skip(1)->take(1)->first();
        $mediumSlider1 = HomepageSlider::select('id', 'main_slider')->where('main_slider', '!=', NULL)->take(1)->first();
        $mediumSlider2 = HomepageSlider::select('id', 'main_slider')->where('main_slider', '!=', NULL)->skip(1)->take(1)->first();

        $slider = [
            'slider1' => env('APP_URL') . '/slider/' . $smallSlider1->main_slider,
            'slider2' => env('APP_URL') . '/slider/' . $smallSlider2->main_slider,
            'slider3' => env('APP_URL') . '/slider/' . $mediumSlider1->main_slider,
            'slider4' => env('APP_URL') . '/slider/' . $mediumSlider2->main_slider,
        ];

        return response()->json([
            'success' => true,
            'message' => 'successfully fetch',
            'data' => $slider,
        ]);
    }

    public function getMainSliders()
    {
        $mainSliders = HomepageSlider::select('id', 'main_slider')->where('main_slider', '!=', NULL)->get();
        $slider = [];
        foreach ($mainSliders as $mainSlider) {
            $slider[] = [
                env('APP_URL') . '/slider/' . $mainSlider->main_slider,
            ];
        }

        return response()->json([
            'success' => true,
            'message' => 'successfully fetch',
            'data' => $slider,
        ]);
    }

    public function getStates()
    {
        $states = States::select('id', 'name', 'code')->get();
        if (count($states) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'states not found',

            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'successfully fetch',
            'data' => $states

        ]);
    }

    public function getCities(Request $request)
    {
        $state = States::where('code', $request->get('code'))->first();
        if (!$state) {
            return response()->json([
                'success' => false,
                'message' => 'State not found'
            ]);
        }
        $cities = City::select('id', 'name', 'state_id')->where('state_id', $state->id)->get();
        if (count($cities) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cities not found',
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'successfully fetch',
            'data' => $cities
        ]);
    }

    public function postUpdateProfile(Request $request)
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
        $user = User::find($request->get('userId'));
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ]);
        }
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->mobile_num = $request->get('mobile_num');
        $user->birth_date = Carbon::parse($request->get('birth_date'))->format('d-m-Y');
        $user->gender = $request->get('gender');
        $user->state = $request->get('state');
        $user->city = $request->get('city');
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User Profile updated'
        ]);
    }

    public function postAddAddress(Request $request)
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
                'success' => false,
                'message' => $validator->errors(),
            ]);
        }
        $user = User::find($request->get('userId'));
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ]);
        }
        if ($request->get('addressId')) {
            $user = User::find($request->get('userId'));
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found',
                ]);
            }
            $shippingAddress = ShippingAddress::find($request->get('addressId'));
        } else {
            $shippingAddress = new ShippingAddress();
        }
        $shippingAddress->user_id = $request->get('userId');
        $shippingAddress->first_name = $request->get('first_name');
        $shippingAddress->last_name = $request->get('last_name');
        $shippingAddress->city = $request->get('city');
        $shippingAddress->state = $request->get('state');
        $shippingAddress->pin_code = $request->get('pin_code');
        $shippingAddress->mobile_num = $request->get('mobile_num');
        $shippingAddress->address = $request->get('address');
        $shippingAddress->save();
        if ($request->get('addressId')) {
            $message = 'Address updated successfully';
        } else {
            $message = 'Address added successfully';
        }
        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    public function getAddress(Request $request)
    {
        $address = ShippingAddress::where('user_id', $request->get('userId'))->get();
        if (count($address) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Address not found'
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'successfully fetch',
            'data' => $address
        ]);
    }

    public function getDeleteAddress(Request $request)
    {
        $address = ShippingAddress::where('id', $request->get('addressId'))->limit(1)->first();
        if (!$address) {
            return response()->json([
                'success' => false,
                'message' => 'Address not found'
            ]);
        }
        $address->delete();
        return response()->json([
            'success' => true,
            'message' => 'successfully removed'
        ]);
    }

    public function postProductWishlist(Request $request)
    {
        $user = User::find($request->get('userId'));
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ]);
        }
        $product = Products::find($request->get('productId'));
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ]);
        }
        if (Wishlist::where('product_id', $product->id)->limit(1)->first()) {
            $wishlist = Wishlist::where('product_id', $product->id)->limit(1)->first();
            $wishlist->delete();
            return response()->json([
                'success' => true,
                'message' => 'Removed from your wishlist..!',
                'added' => 0
            ]);

        } else {
            $wishlist = new Wishlist();
            $wishlist->user_id = $user->id;
            $wishlist->product_id = $product->id;
            $wishlist->save();
            return response()->json([
                'success' => true,
                'message' => 'Added to your wishlist..!',
                'added' => 1
            ]);
        }
    }

    public function getWishlistProducts(Request $request)
    {
        $user = User::find($request->get('userId'));
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ]);
        }
        $wishlists = Wishlist::select('products.id', 'products.name', 'products.product_img', 'products.slug', 'products.price', 'products.quantity')
            ->join('products', 'products.id', 'wishlist.product_id')
            ->where('wishlist.user_id', $user->id)->get();
        if (count($wishlists) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Wishlist product not found'
            ]);
        }
        $dataArray = [];
        foreach ($wishlists as $wishlist) {
            $discount = $wishlist->getDiscountPrice();
            $dataArray[] =
                [
                    'id' => $wishlist->id,
                    'name' => $wishlist->name,
                    'product_img' => env('APP_URL') . '/268ProductImg/' . $wishlist->product_img,
                    'slug' => $wishlist->slug,
                    'price' => $wishlist->price,
                    'quantity' => $wishlist->quantity,
                    'discount' => ($discount == NULL) ? 0 : $discount,
                ];
        }

        return response()->json([
            'success' => true,
            'message' => 'wishlist product fetch',
            'data' => $dataArray
        ]);
    }

    public function postAddToCart(Request $request)
    {
        $user = User::find($request->get('userId'));
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ]);
        }
        $product = Products::find($request->get('productId'));
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ]);
        }

        if (Cart::where('product_id', $product->id)->where('user_id', $user->id)->limit(1)->first()) {
            $cart = Cart::where('product_id', $product->id)->where('user_id', $user->id)->limit(1)->first();
            if ($cart) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product already in cart..!'
                ]);
            }
        } else {
            $cart = new Cart();
        }

        $cart->user_id = $user->id;
        $cart->product_id = $product->id;
        if (count($product->getDiscountPrice()) > 0) {
            $cart->price = $product->getDiscountPrice();
        } else {
            $cart->price = $product->price;
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
        $cart->save();

        $count = Cart::where('user_id', $user->id)->count();
        return response()->json([
            'success' => true,
            'message' => 'Product added in cart',
            'cart' => $count,
            'cart_id' => $cart->id
        ]);
    }

    public function getCartProducts(Request $request)
    {
        $user = User::find($request->get('userId'));
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ]);
        }

        if ($request->get('cartId')) {
            $cartProduct = Products::select('products.id', 'products.name', 'products.product_img', 'cart.product_id', 'cart.id', 'cart.price', 'products.slug', 'cart.quantity')
                ->join('cart', 'cart.product_id', '=', 'products.id')
                ->where('cart.user_id', $user->id)
                ->where('cart.id', $request->get('cartId'))
                ->orderBy('cart.created_at', 'DESC')
                ->first();
            if (count($cartProduct) == 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart product not found'
                ]);
            }

            $total = DB::table('cart')
                ->join('products', 'products.id', '=', 'cart.product_id')
                ->where('cart.user_id', $user->id)
                ->where('cart.id', $request->get('cartId'))
                ->sum(DB::raw('cart.price * cart.quantity'));
            $dataArray = [];

            $discount = $cartProduct->getDiscountPrice();
            $dataArray[] =
                [
                    'id' => $cartProduct->id,
                    'product_id' => $cartProduct->product_id,
                    'name' => $cartProduct->name,
                    'product_img' => env('APP_URL') . '/268ProductImg/' . $cartProduct->product_img,
                    'slug' => $cartProduct->slug,
                    'price' => $cartProduct->price,
                    'quantity' => $cartProduct->quantity,
                    'discount' => ($discount == NULL) ? 0 : $discount,
                    'total' => $total
                ];

            return response()->json([
                'success' => true,
                'message' => 'Cart product fetch',
                'data' => $dataArray
            ]);
        }

        $cartProducts = Products::select('products.id', 'products.name', 'products.product_img', 'cart.product_id', 'cart.id', 'cart.price', 'products.slug', 'cart.quantity')
            ->join('cart', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $user->id)
            ->orderBy('cart.created_at', 'DESC')
            ->get();
        if (count($cartProducts) == 0) {
            return response()->json(['success' => false,
                'message' => 'Cart product not found']);
        }

        $total = DB::table('cart')
            ->join('products', 'products.id', '=', 'cart.product_id')
            ->where('cart.user_id', $user->id)
            ->sum(DB::raw('cart.price * cart.quantity'));
        $dataArray = [];
        foreach ($cartProducts as $cartProduct) {
            $discount = $cartProduct->getDiscountPrice();
            $dataArray[] =
                [
                    'id' => $cartProduct->id,
                    'product_id' => $cartProduct->product_id,
                    'name' => $cartProduct->name,
                    'product_img' => env('APP_URL') . '/268ProductImg/' . $cartProduct->product_img,
                    'slug' => $cartProduct->slug,
                    'price' => $cartProduct->price,
                    'quantity' => $cartProduct->quantity,
                    'discount' => ($discount == NULL) ? 0 : $discount,
                    'total' => $total
                ];
        }

        return response()->json([
            'success' => true,
            'message' => 'Cart product fetch',
            'data' => $dataArray
        ]);
    }

    public
    function getRechargeHistory(Request $request)
    {
        $user = User::find($request->get('userId'));
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ]);
        }
        $rechargeOrders = RechargeHistory::select('recharge_history.recharge_num', 'recharge_history.status', 'recharge_history.created_at as date', 'recharge_history.amount', 'recharge_history.transaction_id', 'operators.name as operator')
            ->join('operators', 'operators.id', 'recharge_history.operator_id')
            ->where('recharge_history.user_id', $user->id)
            ->orderBy('recharge_history.id', 'DESC')
            ->get();
        if (count($rechargeOrders) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Recharge history not found'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'successfully fetch',
            'data' => $rechargeOrders
        ]);
    }

    public
    function getProductHistory(Request $request)
    {
        $user = User::find($request->get('userId'));
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ]);
        }

        $productOrders = Order::select('products.name', 'order.price', 'order.created_at', 'order.product_id', 'order.id', 'products.product_img', 'order.status', 'order.quantity', 'order.shipping_method', 'order.shipping', 'order.transaction_id', DB::raw('order.quantity * order.price as total'))
            ->join('products', 'products.id', '=', 'order.product_id')
            ->where('order.user_id', $user->id)
            ->orderBy('products.id', 'DESC')
            ->get();

        if (count($productOrders) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Order history not found'
            ]);
        }
        $dataArray = [];
        foreach ($productOrders as $productOrder) {
            $dataArray[] =
                [
                    'id' => $productOrder->id,
                    'product_id' => $productOrder->product_id,
                    'name' => $productOrder->name,
                    'product_img' => env('APP_URL') . '/268ProductImg/' . $productOrder->product_img,
                    'price' => $productOrder->price,
                    'status' => $productOrder->status,
                    'shipping' => $productOrder->shipping,
                    'quantity' => $productOrder->quantity,
                    'shipping_method' => $productOrder->shipping_method,
                    'transaction_id' => $productOrder->transaction_id,
                    'total' => $productOrder->total,
                    'created_at' => $productOrder->created_at,

                ];
        }

        return response()->json([
            'success' => true,
            'message' => 'successfully fetch',
            'data' => $dataArray
        ]);
    }

    public
    function getWalletHistory(Request $request)
    {
        $user = User::find($request->get('userId'));
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ]);
        }

        $walletOrders = WalletHistory::select('amount', 'transaction_id', 'tran_type')
            ->where('wallet_history.user_id', $user->id)
            ->get();
        if (count($walletOrders) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Wallet history not found'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'successfully fetch',
            'data' => $walletOrders
        ]);
    }

    public
    function getUserDetails(Request $request)
    {
        $user = User::find($request->get('userId'));
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ]);
        }
        $count = Cart::where('user_id', $user->id)->count();
        return response()->json([
            'success' => true,
            'message' => 'successfully fetch',
            'cart' => $count,
            'data' => $user
        ]);
    }

    public
    function getCartQuantityUpdate(Request $request)
    {
        $cart = Cart::find($request->get('cartId'));
        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'Cart not updated something is wrong..!'
            ]);
        }
        $product = Products::find($cart->product_id);
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found..!'
            ]);
        }
        if ($request->get('quantity') > $product->quantity) {
            return response()->json([
                'success' => false,
                'message' => "We're sorry! Only " . $product->quantity . " units of " . $product->name . " for each customer."
            ]);
        }
        $cart->quantity = $request->get('quantity');
        $cart->save();
        $total = DB::table('cart')
            ->join('products', 'products.id', '=', 'cart.product_id')
            ->where('cart.user_id', $cart->user_id)
            ->sum(DB::raw('cart.price * cart.quantity'));

        return response()->json([
            'success' => true,
            'total' => $total
        ]);
    }

    public
    function getCartItemDelete(Request $request)
    {
        $cart = Cart::find($request->get('cartId'));
        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'Cart not found..!'
            ]);
        }
        $cart->delete();
        $count = Cart::where('user_id', $cart->user_id)->count();
        $total = DB::table('cart')
            ->join('products', 'products.id', '=', 'cart.product_id')
            ->where('cart.user_id', $cart->user_id)
            ->sum(DB::raw('cart.price * cart.quantity'));
        return response()->json([
            'success' => true,
            'cart' => $count,
            'total' => $total
        ]);
    }

    public
    function postCheckout(Request $request)
    {
        $user = User::find($request->get('userId'));
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ]);
        }
        $shippingAddress = ShippingAddress::where('id', $request->get('addressId'))->limit(1)->first();
        if (!$shippingAddress) {
            return response()->json([
                'success' => false,
                'message' => 'Address not found..!'
            ]);
        }
        $products = Cart::select('products.id', 'products.name', 'products.product_img', 'cart.price', 'products.slug', 'products.quantity', 'products.sku', 'cart.quantity as cart_quantity', 'cart.id as cartId', 'cart.color as productColor', 'cart.size as productSize', 'users.username')
            ->join('products', 'products.id', '=', 'cart.product_id')
            ->join('users', 'users.id', '=', 'cart.user_id')
            ->where('cart.user_id', $user->id)
            ->orderBy('cart.created_at', 'DESC')
            ->get();
        $uniqueId = $this->userManager->saveProductOrders($products, $user->id, $shippingAddress, $request->get('shipping_type'), $request->get('payment_type'));
        if ($request->get('payment_type') == 'wallet') {
            $user->wallet_amount = $user->wallet_amount - $request->get('total_amount');
            $user->save();
            foreach ($products as $cartProduct) {
                $cartProduct->delete();
            }
        }
        if ($request->get('payment_type') == 'cod') {
            foreach ($products as $cartProduct) {
                $cartProduct->delete();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Order place successfully..',
            'uniqueId' => $uniqueId
        ]);
    }

    public
    function postSingleProductCheckout(Request $request)
    {
        $user = User::find($request->get('userId'));
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ]);
        }
        $shippingAddress = ShippingAddress::where('id', $request->get('addressId'))->limit(1)->first();
        if (!$shippingAddress) {
            return response()->json([
                'success' => false,
                'message' => 'Address not found..!'
            ]);
        }
        $products = Cart::select('products.id', 'products.name', 'products.product_img', 'cart.price', 'products.slug', 'products.quantity', 'products.sku', 'cart.quantity as cart_quantity', 'cart.id as cartId', 'cart.color as productColor', 'cart.size as productSize', 'users.username')
            ->join('products', 'products.id', '=', 'cart.product_id')
            ->join('users', 'users.id', '=', 'cart.user_id')
            ->where('cart.user_id', $user->id)
            ->where('cart.id', $request->get('cartId'))
            ->orderBy('cart.created_at', 'DESC')
            ->first();
        $uniqueId = $this->userManager->saveSingleProductOrders($products, $user->id, $shippingAddress, $request->get('shipping_type'), $request->get('payment_type'));
        if ($request->get('payment_type') == 'wallet') {
            $user->wallet_amount = $user->wallet_amount - $request->get('total_amount');
            $user->save();
            foreach ($products as $cartProduct) {
                $cartProduct->delete();
            }
        }
        if ($request->get('payment_type') == 'cod') {
            foreach ($products as $cartProduct) {
                $cartProduct->delete();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Order place successfully..',
            'uniqueId' => $uniqueId
        ]);
    }

    public
    function getPrepaidOperator()
    {
        $prepaid = Operators::select('operators.id', 'operators.name', 'operators.op_code')
            ->join('services', 'services.id', 'operators.service_id')
            ->where('services.name', RechargeHistory::PREPAIDRECHARGE)
            ->where('operators.status', 1)
            ->get();

        $circles = Circle::select('id', 'name', 'code')->get();

        return response()->json([
            'success' => true,
            'message' => 'successfully fetch',
            'operators' => $prepaid,
            'circle' => $circles
        ]);
    }

    public
    function getDthOperator()
    {
        $dth = Operators::select('operators.id', 'operators.name', 'operators.op_code')
            ->join('services', 'services.id', 'operators.service_id')
            ->where('services.name', RechargeHistory::DTHRECHARGE)
            ->where('operators.status', 1)
            ->get();

        $circles = Circle::select('id', 'name', 'code')->get();

        return response()->json([
            'success' => true,
            'message' => 'successfully fetch',
            'operators' => $dth,
            'circle' => $circles
        ]);
    }

    public
    function getDatacardOperator()
    {
        $datacard = Operators::select('operators.id', 'operators.name', 'operators.op_code')
            ->join('services', 'services.id', 'operators.service_id')
            ->where('services.name', RechargeHistory::PREPAIDRECHARGE)
            ->where('operators.status', 1)
            ->get();
        $circles = Circle::select('id', 'name', 'code')->get();

        return response()->json([
            'success' => true,
            'message' => 'successfully fetch',
            'operators' => $datacard,
            'circle' => $circles
        ]);
    }

    public
    function getPostpaidOperator()
    {
        $postpaid = Operators::select('operators.id', 'operators.name', 'operators.op_code')
            ->join('services', 'services.id', 'operators.service_id')
            ->where('services.name', RechargeHistory::POSTPAIDRECHARGE)
            ->where('operators.status', 1)
            ->get();
        $circles = Circle::select('id', 'name', 'code')->get();

        return response()->json([
            'success' => true,
            'message' => 'successfully fetch',
            'operators' => $postpaid,
            'circle' => $circles
        ]);
    }

    public function getPrepaidRecharge(Request $request)
    {
        if($request->get('type') == RechargeHistory::DTHRECHARGE){
            $validator = Validator::make($request->all(), [
                'recharge_num' => 'required',
                'operator' => 'required',
                'amount' => 'required|integer',
                'circle' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()
                ]);
            }
        }else{
            $validator = Validator::make($request->all(), [
                'recharge_num' => 'required|regex:/[0-9]{10}/|digits:10',
                'operator' => 'required',
                'amount' => 'required|integer',
                'circle' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()
                ]);
            }
        }

        $user = User::find($request->get('userId'));
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ]);
        }

        DB::beginTransaction();
        try {
            if ($request->get('payment_type') == 'wallet' && $request->get('amount') <= $user->wallet_amount) {
                $recharge = new RechargeHistory();
                $service = Services::where('name', $request->get('type'))->first();
                if (!$service) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Service not found'
                    ]);
                }
                $this->apiManager->saveRechargeHistory($recharge, $user->id, $request);
                $recharge->service_id = $service->id;
                $recharge->save();

                $opCode = Operators::find($recharge->operator_id);
                $myurl = "http://response.rcpanel.com/api_users/recharge?username=110298&pwd=3y691ai0&circlecode=" . $request->get('circle') . "&operatorcode=" . $opCode->op_code . "&number=" . $recharge->recharge_num . "&amount=" . $request->get('amount') . "&orderid=" . $recharge->transaction_id . "";
                $result = $this->rechargeManager->curl_get($myurl);
                $myArray = explode('#', $result);
                if (is_array($myArray)) {
                    $recharge->res_trans_id = $myArray[0];
                    $recharge->status = $myArray[1];
                    $recharge->save();

                    if ($myArray[1] == 'Pending') {
                        $myurl1 = "http://response.rcpanel.com/api_users/status?username=110298&pwd=3y691ai0&orderid=" . $recharge->transaction_id . "&txnid=" . $recharge->res_trans_id . "";
                        $status = $this->rechargeManager->curl_get($myurl1);
                        $myArray = explode('#', $status);
                        $recharge->status = $myArray[0];
                        $recharge->operator = $myArray[1];
                        $recharge->save();
                    }
                }
                DB::commit();
                if ($recharge->status == 'Success') {
                    $user->wallet_amount = $user->wallet_amount - $request->get('amount');
                    $user->save();
                    $operator = Operators::find($recharge->operator_id);
                    $data = array('username' => $user->username, 'email' => $user->email, 'mobile_num' => $recharge->recharge_num, 'amount' => $recharge->amount, 'status' => $recharge->status, 'operator' => $operator->name);
                    $this->mailService->sendRechargeMail($data, $user);
                    return response()->json([
                        'success' => true,
                        'message' => 'Recharge Success',
                        'status' => 'Success'
                    ]);
                } elseif ($recharge->status == 'Failure') {
                    $operator = Operators::find($recharge->operator_id);
                    $data = array('username' => $user->username, 'email' => $user->email, 'mobile_num' => $recharge->recharge_num, 'amount' => $recharge->amount, 'status' => $recharge->status, 'operator' => $operator->name);
                    $this->mailService->sendRechargeMail($data, $user);
                    return response()->json([
                        'success' => false,
                        'message' => 'Recharge failed',
                        'status' => 'Failure'
                    ]);
                } else {
                    $operator = Operators::find($recharge->operator_id);
                    $data = array('username' => $user->username, 'email' => $user->email, 'mobile_num' => $recharge->recharge_num, 'amount' => $recharge->amount, 'status' => $recharge->status, 'operator' => $operator->name);
                    $this->mailService->sendRechargeMail($data, $user);
                    return response()->json([
                        'success' => true,
                        'message' => 'Recharge pending',
                        'status' => 'Pending'
                    ]);
                }

            } elseif ($request->get('payment_type') == 'debit') {
                $recharge = new RechargeHistory();
                $service = Services::where('name', $request->get('type'))->first();
                if (!$service) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Service not found'
                    ]);
                }
                $recharge->service_id = $service->id;
                $this->apiManager->saveRechargeHistory($recharge, $user->id, $request);
                $recharge->save();
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'recharge history added',
                    'data' => $recharge->transaction_id
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient wallet amount!'
                ]);
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
    function getChangePassword(Request $request)
    {
        $user = User::find($request->get('userId'));
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ]);
        }
        $user->otp = rand(100000, 999999);
        $user->save();

        $result = $this->apiManager->sendOtp($user);
        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'OTP not send'
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'OTP send successfully'
        ]);
    }

    public
    function postVerifyPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }

        $user = User::where('otp', $request->get('otp'))->limit(1)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'user not found'
            ]);
        }
        $user->password = bcrypt($request->get('password'));
        $user->otp = NULL;
        $user->save();
        $role = Role::where('name', 'customer')->first();
        $user->attachRole($role);
        return response()->json([
            'success' => true,
            'message' => 'Password change successfully..!'
        ]);
    }

    public
    function getAboutUs()
    {
        $about = AboutUs::select('desc')->limit(1)->first();
        if (!$about) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Data fetch',
            'data' => $about->desc
        ]);
    }

    public
    function getTermsConditions()
    {
        $terms = TermsCondition::select('desc')->limit(1)->first();
        if (!$terms) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Data fetch',
            'data' => $terms->desc
        ]);
    }

    public
    function getDeliveryInfo()
    {
        $deliveryInfo = DeliveryInfo::select('desc')->limit(1)->first();
        if (!$deliveryInfo) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Data fetch',
            'data' => $deliveryInfo->desc
        ]);
    }

    public
    function getCancellationReturns()
    {
        $cancellation = CancellationPolicy::select('desc')->limit(1)->first();
        if (!$cancellation) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Data fetch',
            'data' => $cancellation->desc
        ]);
    }

    public
    function getSellerPolicy()
    {
        $sellerPolicy = SellerPolicy::select('desc')->limit(1)->first();
        if (!$sellerPolicy) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Data fetch',
            'data' => $sellerPolicy->desc
        ]);
    }

    public
    function getFAQ()
    {
        $faq = FAQ::select('desc')->limit(1)->first();
        if (!$faq) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Data fetch',
            'data' => $faq->desc
        ]);
    }

    public
    function getTestimonials()
    {
        $testimonials = Testimonials::select('id', 'title', 'desc', 'image')->get();
        if (!$testimonials) {
            return response()->json([
                'success' => false,
                'message' => 'Testimonials not found'
            ]);
        }
        $dataArray = [];
        foreach ($testimonials as $testimonial) {
            $dataArray[] =
                [
                    'id' => $testimonial->id,
                    'title' => $testimonial->title,
                    'desc' => $testimonial->desc,
                    'image' => env('APP_URL') . '/otherpages/' . $testimonial->image,
                ];
        }
        return response()->json([
            'success' => true,
            'message' => 'Testimonials fetch',
            'data' => $dataArray
        ]);
    }

    public
    function postContactUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'message' => 'required',
            'subject' => 'required',
            'order_reference' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $data = array('email' => $request->get('email'), 'msg' => $request->get('message'), 'subject' => $request->get('subject'), 'order_reference' => $request->get('order_reference'));
        $this->mailService->sendContactUsMail($data, $request->get('email'));
        $this->mailService->sendThankYouContactUsMail($data, $request->get('email'));

        return response()->json([
            'success' => true,
            'message' => 'Your report send successfully..!'
        ]);
    }

    public
    function getAddMoneyWallet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => "required|regex:/^\d*(\.\d{1,2})?$/",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $user = User::find($request->get('userId'));
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ]);
        }

        DB::beginTransaction();
        try {
            $amount = $request->get('amount');
            $walletHistory = new WalletHistory();
            $uniqueId = $this->userManager->randomKey();
            $walletHistory = $this->walletManager->saveWalletMoney($walletHistory, $user, $amount, $uniqueId);
            $walletHistory->save();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Wallet added success..!',
                'data' => $uniqueId
            ]);
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
    function getFilter(Request $request)
    {
        switch ($request) {
            case ($request->get('name') == 'subcat'):
                $subcategory = SubCategory::where('id', $request->get('subcatId'))->limit(1)->first();
                if (!$subcategory) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Subcategory not found'
                    ]);
                }
                $products = Products::select('products.*')
                    ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                    ->where('subcategories.id', $subcategory->id)
                    ->where('products.status', 1)
                    ->get();

                $prices = [];
                foreach ($products as $product) {
                    $price = $product->getDiscountPrice();
                    if ($price) {
                        $prices[] = $price;
                    } else {
                        $prices[] = $product->price;
                    }
                }
                if (count($prices) > 0) {
                    $max = max($prices);
                } else {
                    $max = 0;
                }

                $productBrands = Brands::select('brands.id as brandId')
                    ->join('products', 'products.brand_id', '=', 'brands.id')
                    ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                    ->where('subcategories.slug', $subcategory->slug)
                    ->groupBy('brandId')
                    ->get();
                $brands = [];
                foreach ($productBrands as $productBrand) {
                    $brand = Brands::find($productBrand->brandId);
                    $brands[] =
                        [
                            'id' => $brand->id,
                            'name' => $brand->name,
                        ];
                }

                $productColors = ProductsAttributes::select('product_attributes.id', 'product_attributes.name', 'product_attributes.desc')
                    ->join('products', 'products.id', '=', 'product_attributes.product_id')
                    ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                    ->where('subcategories.slug', $subcategory->slug)
                    ->where('product_attributes.name', 'color')
                    ->get();

                $colors = [];
                $color = [];
                foreach ($productColors as $productColor) {
                    if (!in_array("$productColor->desc", $color)) {
                        $color[] = $productColor->desc;
                        $colors[] =
                            [
                                'id' => $productColor->id,
                                'color' => $productColor->desc,
                            ];
                    }
                }

                $productSizes = ProductsAttributes::select('product_attributes.*')
                    ->join('products', 'products.id', '=', 'product_attributes.product_id')
                    ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                    ->where('subcategories.slug', $subcategory->slug)
                    ->where('product_attributes.name', 'size')
                    ->get();

                $sizes = [];
                $size = [];
                foreach ($productSizes as $productSize) {
                    if (!in_array("$productSize->desc", $size)) {
                        $size[] = $productSize->desc;
                        $sizes[] =
                            [
                                'id' => $productSize->id,
                                'size' => $productSize->desc,
                            ];
                    }
                }
                return response()->json([
                    'success' => true,
                    'message' => 'successfully fetch',
                    'max' => $max,
                    'brands' => $brands,
                    'colors' => $colors,
                    'sizes' => $sizes
                ]);
                break;
            case ($request->get('name') == 'topseller'):
                $topSellerProducts = $this->userManager->getTopSellerProducts();
                if (count($topSellerProducts) == 0) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Products not fetch'
                    ]);
                }

                $prices = [];
                foreach ($topSellerProducts as $product) {
                    $price = $product->getDiscountPrice();
                    if ($price) {
                        $prices[] = $price;
                    } else {
                        $prices[] = $product->price;
                    }
                }
                if (count($prices) > 0) {
                    $max = max($prices);
                } else {
                    $max = 0;
                }

                $productBrands = Brands::select('brands.id as brandId', DB::raw("(select max('rating') from product_review)"))
                    ->join('products', 'products.brand_id', '=', 'brands.id')
                    ->join('product_review', 'product_review.product_id', '=', 'products.id')
                    ->groupBy('brandId')
                    ->get();
                $brands = [];
                foreach ($productBrands as $productBrand) {
                    $brand = Brands::find($productBrand->brandId);
                    $brands[] =
                        [
                            'id' => $brand->id,
                            'name' => $brand->name,
                        ];
                }

                return response()->json([
                    'success' => true,
                    'message' => 'successfully fetch',
                    'max' => $max,
                    'brands' => $brands,
                    'colors' => [],
                    'sizes' => []
                ]);
                break;
            case ($request->get('name') == 'newarrival'):
                $newArrivalsProducts = $this->userManager->getNewArrivalsProducts();
                $prices = [];
                foreach ($newArrivalsProducts as $product) {
                    $price = $product->getDiscountPrice();
                    if ($price) {
                        $prices[] = $price;
                    } else {
                        $prices[] = $product->price;
                    }
                }
                if (count($prices) > 0) {
                    $max = max($prices);
                } else {
                    $max = 0;
                }

                $productBrands = Brands::select('brands.id as brandId')
                    ->join('products', 'products.brand_id', '=', 'brands.id')
                    ->where('products.new_arrival', 1)
                    ->groupBy('brandId')
                    ->get();
                $brands = [];
                foreach ($productBrands as $productBrand) {
                    $brand = Brands::find($productBrand->brandId);
                    $brands[] =
                        [
                            'id' => $brand->id,
                            'name' => $brand->name,
                        ];
                }

                return response()->json([
                    'success' => true,
                    'message' => 'successfully fetch',
                    'max' => $max,
                    'brands' => $brands,
                    'colors' => [],
                    'sizes' => []
                ]);
                break;
            case ($request->get('name') == 'specialproduct'):
                $specialProducts = $this->userManager->getSpecialProducts();
                $prices = [];
                foreach ($specialProducts as $product) {
                    $price = $product->getDiscountPrice();
                    if ($price) {
                        $prices[] = $price;
                    } else {
                        $prices[] = $product->price;
                    }
                }
                if (count($prices) > 0) {
                    $max = max($prices);
                } else {
                    $max = 0;
                }

                $productBrands = Brands::select('brands.id as brandId')
                    ->join('products', 'products.brand_id', '=', 'brands.id')
                    ->where('products.status', 1)
                    ->where('products.special', 1)
                    ->groupBy('brandId')
                    ->get();
                $brands = [];
                foreach ($productBrands as $productBrand) {
                    $brand = Brands::find($productBrand->brandId);
                    $brands[] =
                        [
                            'id' => $brand->id,
                            'name' => $brand->name,
                        ];
                }

                return response()->json([
                    'success' => true,
                    'message' => 'successfully fetch',
                    'max' => $max,
                    'brands' => $brands,
                    'colors' => [],
                    'sizes' => []
                ]);
                break;
            case ($request->get('name') == 'recommandet'):
                $recommendProducts = $this->userManager->getRecommendProducts();
                $prices = [];
                foreach ($recommendProducts as $product) {
                    $price = $product->getDiscountPrice();
                    if ($price) {
                        $prices[] = $price;
                    } else {
                        $prices[] = $product->price;
                    }
                }
                if (count($prices) > 0) {
                    $max = max($prices);
                } else {
                    $max = 0;
                }

                $productBrands = Brands::select('brands.id as brandId')
                    ->join('products', 'products.brand_id', '=', 'brands.id')
                    ->where('products.status', 1)
                    ->where('products.recommend', 1)
                    ->groupBy('brandId')
                    ->get();
                $brands = [];
                foreach ($productBrands as $productBrand) {
                    $brand = Brands::find($productBrand->brandId);
                    $brands[] =
                        [
                            'id' => $brand->id,
                            'name' => $brand->name,
                        ];
                }

                return response()->json([
                    'success' => true,
                    'message' => 'successfully fetch',
                    'max' => $max,
                    'brands' => $brands,
                    'colors' => [],
                    'sizes' => []
                ]);
                break;
            case ($request->get('name') == 'upto40'):
                $upTo40Discounts = $this->userManager->getDiscountProducts('1', '40');
                $prices = [];
                $brands = [];
                $brandId = [];
                foreach ($upTo40Discounts as $product) {
                    $price = $product->getDiscountPrice();
                    if ($price) {
                        $prices[] = $price;
                    } else {
                        $prices[] = $product->price;
                    }
                    if (!in_array($product->brand_id, $brandId)) {
                        $brand = Brands::find($product->brand_id);
                        $brandId[] = $product->brand_id;
                        $brands[] =
                            [
                                'id' => $brand->id,
                                'name' => $brand->name,
                            ];
                    }
                }
                if (count($prices) > 0) {
                    $max = max($prices);
                } else {
                    $max = 0;
                }

                return response()->json([
                    'success' => true,
                    'message' => 'successfully fetch',
                    'max' => $max,
                    'brands' => $brands,
                    'colors' => [],
                    'sizes' => []
                ]);
                break;
            case ($request->get('name') == 'upto50'):
                $upTo50Discounts = $this->userManager->getDiscountProducts('41', '50');
                $prices = [];
                $brands = [];
                $brandId = [];
                foreach ($upTo50Discounts as $product) {
                    $price = $product->getDiscountPrice();
                    if ($price) {
                        $prices[] = $price;
                    } else {
                        $prices[] = $product->price;
                    }
                    if (!in_array($product->brand_id, $brandId)) {
                        $brand = Brands::find($product->brand_id);
                        $brandId[] = $product->brand_id;
                        $brands[] =
                            [
                                'id' => $brand->id,
                                'name' => $brand->name,
                            ];
                    }
                }
                if (count($prices) > 0) {
                    $max = max($prices);
                } else {
                    $max = 0;
                }

                return response()->json([
                    'success' => true,
                    'message' => 'successfully fetch',
                    'max' => $max,
                    'brands' => $brands,
                    'colors' => [],
                    'sizes' => []
                ]);
                break;
            case ($request->get('name') == 'upto60'):
                $upTo60Discounts = $this->userManager->getDiscountProducts('51', '60');
                $prices = [];
                $brands = [];
                $brandId = [];
                foreach ($upTo60Discounts as $product) {
                    $price = $product->getDiscountPrice();
                    if ($price) {
                        $prices[] = $price;
                    } else {
                        $prices[] = $product->price;
                    }
                    if (!in_array($product->brand_id, $brandId)) {
                        $brand = Brands::find($product->brand_id);
                        $brandId[] = $product->brand_id;
                        $brands[] =
                            [
                                'id' => $brand->id,
                                'name' => $brand->name,
                            ];
                    }
                }
                if (count($prices) > 0) {
                    $max = max($prices);
                } else {
                    $max = 0;
                }

                return response()->json([
                    'success' => true,
                    'message' => 'successfully fetch',
                    'max' => $max,
                    'brands' => $brands,
                    'colors' => [],
                    'sizes' => []
                ]);
                break;
            case ($request->get('name') == 'upto70'):
                $upTo70Discounts = $this->userManager->getDiscountProducts('61', '70');
                $prices = [];
                $brands = [];
                $brandId = [];
                foreach ($upTo70Discounts as $product) {
                    $price = $product->getDiscountPrice();
                    if ($price) {
                        $prices[] = $price;
                    } else {
                        $prices[] = $product->price;
                    }
                    if (!in_array($product->brand_id, $brandId)) {
                        $brand = Brands::find($product->brand_id);
                        $brandId[] = $product->brand_id;
                        $brands[] =
                            [
                                'id' => $brand->id,
                                'name' => $brand->name,
                            ];
                    }
                }
                if (count($prices) > 0) {
                    $max = max($prices);
                } else {
                    $max = 0;
                }

                return response()->json([
                    'success' => true,
                    'message' => 'successfully fetch',
                    'max' => $max,
                    'brands' => $brands,
                    'colors' => [],
                    'sizes' => []
                ]);
                break;
            case ($request->get('name') == 'upto80'):
                $upTo80Discounts = $this->userManager->getDiscountProducts('71', '80');
                $prices = [];
                $brands = [];
                $brandId = [];
                foreach ($upTo80Discounts as $product) {
                    $price = $product->getDiscountPrice();
                    if ($price) {
                        $prices[] = $price;
                    } else {
                        $prices[] = $product->price;
                    }
                    if (!in_array($product->brand_id, $brandId)) {
                        $brand = Brands::find($product->brand_id);
                        $brandId[] = $product->brand_id;
                        $brands[] =
                            [
                                'id' => $brand->id,
                                'name' => $brand->name,
                            ];
                    }
                }
                if (count($prices) > 0) {
                    $max = max($prices);
                } else {
                    $max = 0;
                }

                return response()->json([
                    'success' => true,
                    'message' => 'successfully fetch',
                    'max' => $max,
                    'brands' => $brands,
                    'colors' => [],
                    'sizes' => []
                ]);
                break;
            default:
                return response()->json([
                    'success' => false,
                    'message' => 'Data not fetch'
                ]);
        }
    }

    public
    function postFilterApply(Request $request)
    {
        switch ($request) {
            case ($request->get('name') == 'subcat'):
                
                $subcategory = SubCategory::select('id', 'slug')->where('id', $request->get('subcatId'))->limit(1)->first();
                if (!$subcategory) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Subcategory not found'
                    ]);
                }

                $dataArray = [];
                $products = [];
                if ($request->has('min') && $request->has('max')) {
                    $data = Products::select(DB::raw("products.*, product_discount.price as discount"))
                        ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                        ->leftJoin('product_discount', 'products.id', '=', 'product_discount.product_id')
                        ->where('subcategories.id', $subcategory->id)
                        ->get();
                    foreach ($data as $product) {
                        if ($product->discount == null) {
                            $data1 = Products::select(DB::raw("products.*, brands.id as brandId"))
                                ->join('brands', 'brands.id', '=', 'products.brand_id')
                                ->whereBetween('price', [$request->get('min'), $request->get('max')])
                                ->where('products.id', $product->id)
                                ->first();
                            if ($data1) {
                                $products[] = $data1;
                            }
                        } else {
                            $data2 = Products::select(DB::raw("products.*, brands.id as brandId , product_discount.price as discount"))
                                ->leftJoin('product_discount', 'products.id', '=', 'product_discount.product_id')
                                ->join('brands', 'brands.id', '=', 'products.brand_id')
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
                    $dataArray = [];
                    $j=0;
                    foreach ($products as $product) {
                        $discount = $product->getDiscountPrice();
                        
                        $productColors = ProductsAttributes::select('id', 'desc')->where('product_id', $product->id)->where('name', 'color')->get();
                        
                        
                        
                        
                        
                           $dataArray[] =
                            [
                                'id' => $product->id,
                                'name' => $product->name,
                                'product_img' => env('APP_URL') . '/268ProductImg/' . $product->product_img,
                                'slug' => $product->slug,
                                'price' => $product->price,
                                'quantity' => $product->quantity,
                                'discount' => ($discount == NULL) ? 0 : $discount,
                                'brandId' => $product->brandId,
                                
                            ];
                           
                        
                        
                        
                        
                           
                    }
                    
                    if ($request->has('brand')) {
                        $brnd = explode(",",$request->get('brand'));
                        $collection = collect($dataArray);
                        $n= sizeof($brnd);
                        
                        $filteredItems = [];
                        for($i=0;$i<$n;$i++){
                            $filteredItems1 = $collection->Where('brandId', $brnd[$i]);
                            if(sizeof($filteredItems1) == 0){
                                
                            }else{
                                array_push($filteredItems,$filteredItems1);
                            }
                             
                        }
                        
                        // $products = Products::select('products.id', 'products.name', 'products.product_img', 'products.slug', 'products.price', 'products.quantity')
                        //     ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                        //     ->join('brands', 'brands.id', '=', 'products.brand_id')
                        //     ->where('subcategories.id', $subcategory->id)
                        //     ->whereIn('brands.id', $request->get('brand'))
                        //     ->where('products.status', 1)->get();
                        // foreach ($products as $product) {
                        //     $discount = $product->getDiscountPrice();
                        //     $dataArray[] =
                        //         [
                        //             'id' => $product->id,
                        //             'name' => $product->name,
                        //             'product_img' => env('APP_URL') . '/268ProductImg/' . $product->product_img,
                        //             'slug' => $product->slug,
                        //             'price' => $product->price,
                        //             'quantity' => $product->quantity,
                        //             'discount' => ($discount == NULL) ? 0 : $discount,
                        //         ];
                        // }
                        $dataArray = $filteredItems;
                    }
                    if ($request->has('color')) {
                        $collection = collect($dataArray);
                        $filteredItems = $collection->where('color', $request->get('color'));
                        $dataArray = $filteredItems;
                    }
                    

                    return response()->json([
                        'success' => true,
                        'message' => 'Price range product fetch',
                        'data' => $dataArray
                    ]);

                }


                if ($request->has('color')) {
                    $productId = Products::select('products.id')
                        ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
                        ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                        ->whereIn('product_attributes.id', $request->get('color'))
                        ->where('subcategories.id', $subcategory->id)
                        ->where('products.status', 1)
                        ->groupBy('id')
                        ->get();

                    $products = Products::select('products.*')
                        ->whereIn('products.id', $productId)
                        ->get();

                    foreach ($products as $product) {
                        $discount = $product->getDiscountPrice();
                        $dataArray[] =
                            [
                                'id' => $product->id,
                                'name' => $product->name,
                                'product_img' => env('APP_URL') . '/268ProductImg/' . $product->product_img,
                                'slug' => $product->slug,
                                'price' => $product->price,
                                'quantity' => $product->quantity,
                                'discount' => ($discount == NULL) ? 0 : $discount,
                            ];
                    }
                }
                if ($request->has('size')) {
                    $products = Products::select('products.id', 'products.name', 'products.product_img', 'products.slug', 'products.price', 'products.quantity')
                        ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
                        ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                        ->where('subcategories.id', $subcategory->id)
                        ->whereIn('product_attributes.id', $request->get('size'))
                        ->where('products.status', 1)
                        ->get();
                    foreach ($products as $product) {
                        $discount = $product->getDiscountPrice();
                        $dataArray[] =
                            [
                                'id' => $product->id,
                                'name' => $product->name,
                                'product_img' => env('APP_URL') . '/268ProductImg/' . $product->product_img,
                                'slug' => $product->slug,
                                'price' => $product->price,
                                'quantity' => $product->quantity,
                                'discount' => ($discount == NULL) ? 0 : $discount,
                                
                            ];
                    }
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Filter product fetch',
                    'data' => $dataArray
                ]);
                break;
            case ($request->get('name') == 'topseller'):
                $products = [];
                if ($request->has('min') && $request->has('max')) {
                    $data = Products::select('products.price','products.name','product_discount.price as discount', DB::raw("(select max('rating') from product_review)"))
                        ->join('product_review', 'product_review.product_id', '=', 'products.id')
                        ->leftJoin('product_discount', 'products.id', '=', 'product_discount.product_id')
                        ->where('products.status', 1)
                        ->orderBy('products.created_at', 'DESC')
                        ->get();
                        
                    foreach ($data as $product) {
                        if ($product->discount == null) {
                            $data1 = Products::select(DB::raw("products.*, brands.id as brandId"))
                                ->join('brands', 'brands.id', '=', 'products.brand_id')
                                ->whereBetween('price', [$request->get('min'), $request->get('max')])
                                ->where('products.id', $product->id)
                                ->first();
                            if ($data1) {
                                $products[] = $data1;
                            }
                        } else {
                            $data2 = Products::select(DB::raw("products.*, brands.id as brandId , product_discount.price as discount"))
                                ->leftJoin('product_discount', 'products.id', '=', 'product_discount.product_id')
                                ->join('brands', 'brands.id', '=', 'products.brand_id')
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
                    
                    $dataArray = [];
                    foreach ($products as $product) {
                        $discount = $product->getDiscountPrice();
                        $dataArray[] =
                            [
                                'id' => $product->id,
                                'name' => $product->name,
                                'product_img' => env('APP_URL') . '/268ProductImg/' . $product->product_img,
                                'slug' => $product->slug,
                                'price' => $product->price,
                                'quantity' => $product->quantity,
                                'discount' => ($discount == NULL) ? 0 : $discount,
                                'brandId' => $product->brandId,
                            ];
                    }

                    return response()->json([
                        'success' => true,
                        'message' => 'Price range product fetch',
                        'data' => $dataArray
                    ]);

                }

                if ($request->has('brand')) {

                    $data = Products::select('products.price','products.name', DB::raw("(select max('rating') from product_review)"))
                        ->join('product_review', 'product_review.product_id', '=', 'products.id')
                        ->join('brands', 'brands.id', '=', 'products.brand_id')
                        ->where('products.status', 1)
                        ->orderBy('products.created_at', 'DESC')
                        ->get();

                    $products = Products::select('products.id', 'products.name', 'products.product_img', 'products.slug', 'products.price', 'products.quantity')
                        ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                        ->join('brands', 'brands.id', '=', 'products.brand_id')
                        ->whereIn('brands.id', $request->get('brand'))
                        ->where('products.status', 1)->get();
                    foreach ($products as $product) {
                        $discount = $product->getDiscountPrice();
                        $dataArray[] =
                            [
                                'id' => $product->id,
                                'name' => $product->name,
                                'product_img' => env('APP_URL') . '/268ProductImg/' . $product->product_img,
                                'slug' => $product->slug,
                                'price' => $product->price,
                                'quantity' => $product->quantity,
                                'discount' => ($discount == NULL) ? 0 : $discount,
                            ];
                    }
                }
        }

    }
    public function postOrderShippingProcess(Request $request)
    {
        $order = Order::where('transaction_id', $request->get('transId'))->limit(1)->first();
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found..!'
            ]);
        }
        if ($order->shipping == $request->get('status')) {
            return \response()->json([
                'success' => false,
                'message' => 'Order already in ' . $request->get('status') . ' process..!'
            ]);
        }
        $order->shipping = $request->get('status');
        $order->delivery_date = Carbon::parse($request->get('delivery_date'))->format('Y-m-d H:i:s');
        $order->save();

        if (ShippingHistory::where('order_id', $order->id)->where('status', $request->get('status'))->limit(1)->first()) {
            $shippingHistory = ShippingHistory::where('order_id', $order->id)->where('status', $request->get('status'))->limit(1)->first();
        } else {
            $shippingHistory = new ShippingHistory();
        }
        $shippingHistory->order_id = $order->id;
        $shippingHistory->status = $request->get('status');
        $shippingHistory->delivery_date = Carbon::parse($request->get('delivery_date'))->format('Y-m-d H:i:s');
        $shippingHistory->remark = $request->get('remark');
        $shippingHistory->save();

        $user = User::find($order->user_id);
        $product = Products::find($order->product_id);
        $data = array('username' => $user->username, 'product' => $product->name, 'shipping' => $order->shipping, 'delivery_date' => Carbon::parse($order->delivery_date)->format('d-m-Y'), 'remark' => $request->get('remark'));
        $this->mailService->sendOrderShippingMail($data, $user);
        
        return response()->json([
            'success' => true,
            'message' => 'Order Updated successfully..!'
        ]);
    }
}
