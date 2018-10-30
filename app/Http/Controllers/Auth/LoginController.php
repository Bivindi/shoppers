<?php

namespace App\Http\Controllers\Auth;

use App\Classes\MailService;
use App\Classes\UserManager;
use App\FAQ;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Model\AboutUs;
use App\Model\CancellationPolicy;
use App\Model\Cart;
use App\Model\Compare;
use App\Model\DeliveryInfo;
use App\Model\Order;
use App\Model\PrivacyPolicy;
use App\Model\RechargeHistory;
use App\Model\SellerPolicy;
use App\Model\User;
use App\Model\Role;
use App\TermsCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * @var UserManager
     */
    private $userManager;
    /**
     * @var MailService
     */
    private $mailService;

    public function __construct(UserManager $userManager, MailService $mailService)
    {
        $this->userManager = $userManager;
        $this->mailService = $mailService;
    }

    public function getLogin()
    {
        if (Auth::check())
        {
            if (Auth::user()->hasRole('admin'))
            {
                return redirect()->route('get:dashboard');
            }
            elseif (Auth::user()->hasRole('seller'))
            {
                return redirect()->route('get:seller');
            }
            elseif (Auth::user()->hasRole('employee'))
            {
                return redirect()->route('get:dashboard');
            }
        }
        else
        {
            return view('admin.auth.login');
        }
    }

    public function getLoginForm()
    {   
       
        return view('front.auth.login_form');
        
    }

    public function postLogin(LoginRequest $request)
    {
        if (!Auth::attempt(['username' => $request->get('username'), 'password' => $request->get('password')])) {
            Session::flash('error', 'Please check your credential!');
            return redirect()->route('login');
        }

        if (!Auth::user()->hasRole('admin') && !Auth::user()->hasRole('seller')&& !Auth::user()->hasRole('employee')) {
            Auth::logout();
            Session::flash('error', 'Something is wrong please try again..!');
            return redirect()->route('login');
        }elseif (Auth::user()->status != 1){
            Auth::logout();
            Session::flash('error', 'you are not approved by admin..!');
            return redirect()->route('login');
        }elseif(Auth::user()->hasRole("seller")){
            return redirect()->route("get:seller");
        }
        Session::flash('success', 'Login successfully!');
        return redirect()->route('get:dashboard');
    }

    public function getLogout()
    {
        Auth::logout();
        Session::flash('success', 'Logout successfully!');
        return redirect()->route('login');
    }

    public function postUserRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'cpassword' => 'required|same:password',
            'password' => 'required',
            'mobile_num' => 'required|regex:/[0-9]{10}/|digits:10|unique:users,mobile_num',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors(),
            ]);
        }
        $user = new User();
        $this->userManager->userRegister($user, $request);
        $role = Role::where('name', 'customer')->first();
        $user->attachRole($role);

        $data = array('username' => $request->get('username'), 'email' => $request->get('email'), 'link' => route('get:homepage'));
        $this->mailService->sendUserMail($data, $user);

        $user = Auth::loginUsingId($user->id);
        if(Session::has('cart_temp_id')){
            $this->userManager->saveAuthenticateCartProducts();
            Session::forget('cart_temp_id');
        }
        if(Session::has('compare_temp_id')){
            $this->userManager->saveAuthenticateCompareProducts();
            Session::forget('compare_temp_id');
        }
        Session::flash('success', 'Welcome ' .$user->username.' you are successfully logged in..!');
        return response()->json([
            'success' => true,
            'message' => 'your register successfully complete..!'
        ]);
    }

    public function getRegister()
    {
        return view('admin.auth.register');
    }

    public function postRegister(UserRegisterRequest $request)
    {
        $user = new User();
        $this->userManager->userRegister($user, $request);
        $role = Role::where('name', 'seller')->first();
        $user->attachRole($role);

        $code = str_random(60);
        $user->confirmation_code = $code;
        $user->save();

        $data = array('username' => $request->get('username'), 'email' => $request->get('email'), 'link' => route('get:seller_verify', $code));
        //$this->mailService->sendSellerRegisterMail($data, $user);

        Session::flash('success', 'your registration successful please check your mail to confirm..!');
        return redirect()->route('login');
    }

    public function getSellerVerify($code)
    {
        $user = User::where('confirmation_code', $code)->first();
        if (!$user) {
            Session::flash('success', 'This confirmation link is expired please try again!');
            return redirect()->route('get:register');
        }
        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        $data = array('username' => $user->username, 'email' => $user->email);
        $this->mailService->sendVerifiedMail($data, $user);

        Session::flash('success', 'Your email is confirmed..!');
        return redirect()->route('login');
    }

    public function postUserLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username_or_mobile' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors(),
            ]);
        }

        if (is_numeric($request->get('username_or_mobile'))) {
            $field = 'mobile_num';
        } else {
            $field = 'username';
        }

        $request->merge([$field => $request->get('username_or_mobile')]);
        if (!Auth::attempt($request->only($field, 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Please check your credential..!',
            ]);
        }

        if (!Auth::user()->hasRole('customer')) {
            Auth::logout();
            return response()->json([
                'success' => false,
                'message' => 'Something is wrong please try again..!',
            ]);
        }
        if(Session::has('cart_temp_id')){
            $this->userManager->saveAuthenticateCartProducts();
            Session::forget('cart_temp_id');
        }
        if(Session::has('compare_temp_id')){
            $this->userManager->saveAuthenticateCompareProducts();
            Session::forget('compare_temp_id');
        }
        if (Session::has('recharge_temp_id')) {
            $this->userManager->saveAuthenticateRechargeOrder();
            Session::forget('recharge_temp_id');
        }
        Session::flash('success', 'Welcome '.Auth::user()->username.' you are successfully logged in..!');

        return response()->json([
            'success' => true,
            'message' => 'You are successfully logged in..!',
            'url' => route('get:homepage')
        ]);
    }

    public function getUserLogout()
    {
        if(Session::has('cart_temp_id')){
            $cartItems = Cart::where('cart_temp_id', Session::get('cart_temp_id'))->get();
            foreach ($cartItems as $cartItem){
                $cartItem->delete();
            }
            Session::forget('cart_temp_id');
        }
        if (Session::has('compare_temp_id')) {
            $compareProducts = Compare::where('compare_temp_id', Session::get('compare_temp_id'))->get();
            foreach ($compareProducts as $compareProduct){
                $compareProduct->delete();
            }
            Session::forget('compare_temp_id');
        }
        if (Session::has('recharge_temp_id')) {
            $rechargeOrder = RechargeHistory::where('recharge_temp_id', Session::get('recharge_temp_id'))->get();
            foreach ($rechargeOrder as $recharge) {
                $recharge->delete();
            }
            Session::forget('recharge_temp_id');
        }
        Auth::logout();
        Session::flash('success', 'Logout successfully!');
        return redirect()->route('get:homepage');
    }

    public function getAboutUs()
    {
        $about = AboutUs::select('desc', 'image')->limit(1)->first();
        return view('front.pages.other.about_us', compact('about'));
    }

    public function getTermsConditions()
    {
        $terms = TermsCondition::select('desc', 'image')->limit(1)->first();
        return view('front.pages.other.terms_condition', compact('terms'));
    }

    public function getDeliveryInfo()
    {
        $deliveryInfo = DeliveryInfo::select('desc', 'image')->limit(1)->first();
        return view('front.pages.other.delivery_info', compact('deliveryInfo'));
    }

    public function getCancellationPolicy()
    {
        $cancellation = CancellationPolicy::select('desc', 'image')->limit(1)->first();
        return view('front.pages.other.cancellation_policy', compact('cancellation'));
    }

    public function getSellerPolicy()
    {
        $sellerPolicy = SellerPolicy::select('desc', 'image')->limit(1)->first();
        return view('front.pages.other.seller_policy', compact('sellerPolicy'));
    }

    public function getFaqSupport()
    {
        $faq = FAQ::select('desc', 'image')->limit(1)->first();
        return view('front.pages.other.faq', compact('faq'));
    }

    public function getPrivacyPolicy()
    {
        $privacy = PrivacyPolicy::select('desc', 'image')->limit(1)->first();
        return view('front.pages.other.privacy_policy', compact('privacy'));
    }

    public function getContactUs()
    {
        return view('front.pages.contact_us');
    }

    public function postContactUs(ContactRequest $request)
    {
        $data = array('email' => $request->get('email'), 'msg' => $request->get('message'), 'subject' => $request->get('subject'), 'order_reference' => $request->get('order_reference'));
        $this->mailService->sendContactUsMail($data, $request->get('email'));
        $this->mailService->sendThankYouContactUsMail($data, $request->get('email'));
        Session::flash('success', 'Your report successfully send..!');
        return redirect()->back();
    }

    public function postForgotPasswordMail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors(),
            ]);
        }

        $user = User::where('email', $request->get('email'))->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email not found..!'
            ]);
        }

        if(!$user->hasRole('customer')){
            return response()->json([
               'success' => false,
                'message' => 'You are not customer..!'
            ]);
        }
        $code = str_random(60);
        $user->confirmation_code = $code;
        $user->save();

        $data = array('username' => $user->username, 'email' => $user->email, 'link' => route('get:reset_password', $code));
        $this->mailService->sendForgotPasswordMail($data, $user);

        Session::flash('success', 'Forgot password link send to your mail!');
        return response()->json([
            'success' => true,
        ]);
    }

    public function getResetPassword($code)
    {
        $user = User::whereConfirmationCode($code)->first();
        if (!$user) {
            Session::flash('error', 'Please try again code has been expired');
            return redirect()->route('get:homepage');
        }
        return view('front.auth.reset_password', compact('code'));
    }

    public function postResetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'cpassword' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors(),
            ]);
        }

        $user = User::whereConfirmationCode($request->get('code'))->first();
        if (!$user) {
            abort(404, 'Data not found');
        }
        $user->password = bcrypt($request->get('password'));
        $user->confirmation_code = null;
        $user->save();
        Session::flash('success', 'Password Change Successfully');
        return response()->json([
           'success' => true,
           'url' => route('get:homepage')
        ]);
    }
}
