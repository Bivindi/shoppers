@extends('admin.auth.layout.default')
@section('page-css')
    <style>
        .login-form {
            width: 100%;
        }
        .error{
            margin-left: 3rem;
        }

        #OpenImgUpload, #imageUpload{
            margin: 0 0 15px 0;
        }
    </style>
@endsection
@section('title')
    Register
@endsection
@section('page-content')
    <div id="login-page" class="row">
        <div class="col s6 z-depth-4 card-panel" style="position: absolute;
            top: 10%;
            left: 25%;">
            <form id="registrationForm" class="login-form" action="{{ route('post:register') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="input-field col s12 center">
                        <img src="{{ asset('assets/images/login-logo1.png') }}" alt=""
                             class="circle responsive-img valign profile-image-login">
                        <p class="center login-form-text">shopper Beem</p>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s6">
                        <i class="mdi-social-person-outline prefix"></i>
                        <input id="first_name" name="first_name" value="{{ old('first_name') }}" type="text">
                        <label for="first_name" class="center-align">First Name</label>
                        <span class="error">{{ $errors->first('first_name') }}</span>
                    </div>
                    <div class="input-field col s6">
                        <i class="mdi-social-person-outline prefix"></i>
                        <input id="last_name" name="last_name" value="{{ old('last_name') }}" type="text">
                        <label for="last_name" class="center-align">Last Name</label>
                        <span class="error">{{ $errors->first('last_name') }}</span>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s6">
                        <i class="mdi-social-person-outline prefix"></i>
                        <input id="username" name="username" value="{{ old('username') }}" type="text">
                        <label for="username" class="center-align">Username</label>
                        <span class="error">{{ $errors->first('username') }}</span>
                    </div>
                    <div class="input-field col s6">
                        <i class="mdi-social-person-outline prefix"></i>
                        <input id="email" name="email" value="{{ old('email') }}" type="email">
                        <label for="email" class="center-align">Email</label>
                        <span class="error">{{ $errors->first('email') }}</span>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s6">
                        <i class="mdi-action-lock-outline prefix"></i>
                        <input id="password" name="password" type="password">
                        <label for="password">Password</label>
                        <span class="error">{{ $errors->first('password') }}</span>
                    </div>
                    <div class="input-field col s6">
                        <i class="mdi-action-lock-outline prefix"></i>
                        <input id="cpassword" name="cpassword" type="password">
                        <label for="cpassword">Confirm Password</label>
                        <span class="error">{{ $errors->first('cpassword') }}</span>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-communication-phone prefix"></i>
                        <input id="mobileNum" name="mobile_num" value="{{ old('mobile_num') }}" type="number">
                        <label for="mobileNum">Mobile Number</label>
                        <span class="error">{{ $errors->first('mobile_num') }}</span>
                    </div>
                </div>
                <hr>
                <p>Kyc Details</p>
                <div class="row margin">
                    <div class="input-field col s6">
                        <i class="mdi-action-payment prefix"></i>
                        <input id="pan" name="pan_tan_number" value="{{ old('pan_tan_number') }}" type="text">
                        <label for="pan">Pan OR Tan Number</label>
                        <span class="error">{{ $errors->first('pan_tan_number') }}</span>
                    </div>
                    <div class="input-field col s6">
                        <i class="mdi-action-payment prefix"></i>
                        <input id="gst" name="gst_number" value="{{ old('gst_number') }}" type="text">
                        <label for="gst">Gst Number</label>
                        <span class="error">{{ $errors->first('gst_number') }}</span>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s6">
                        <i class="mdi-image-camera-alt prefix"></i>
                        <span for="aadharCardFront" style="margin-left: 3rem;">Kyc Documents</span>
                        <input id="aadharCardFront" name="kyc_docs[]" type="file" multiple>
                        <span class="error">{{ $errors->first('kyc_docs[]') }}</span>
                    </div>
                    <div class="input-field col s6">
                        <i class="mdi-image-camera-alt prefix"></i>
                        <span for="aadharCardBack" style="margin-left: 3rem;">Other Documents</span>
                        <input id="aadharCardBack" name="other_docs[]" type="file" multiple>
                        <span class="error">{{ $errors->first('other_docs[]') }}</span>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-action-payment prefix"></i>
                        <input id="aadharCard" name="aadhar_num" value="{{ old('aadhar_num') }}" type="text">
                        <label for="aadharCard">Aadhar Number</label>
                        <span class="error">{{ $errors->first('aadhar_num') }}</span>
                    </div>
                </div>
                
				<div class="form-group row">
                    <label for="categories" class="col-sm-3 col-form-label">Categories :</label>
                    <div class="col-sm-9">
						<select class="js-example-basic-multiple" multiple="multiple" style="width: 100%" requireds>
							@foreach(App\Model\Categories::all() as $c)
                                <option value="{{ $c->id }}" {{ $c->id == 1 ? "selected" : "" }}>{{ $c->name }}</option>
                            @endforeach
	                    </select>
                    </div>
                    <input type="hidden" name="categories_id" class="types" value="">
                </div>

                <div class="row">
                    <div class="input-field col s12 m12 l12  login-text">
                        <input type="checkbox" id="remember-me"/>
                        <label for="remember-me">Remember me</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="btn waves-effect waves-light col s12">Register</button>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 m6 l6">
                        <p class="margin medium-small"><a href="{{ route('login') }}">Login!</a></p>
                    </div>
                    <div class="input-field col s6 m6 l6">
                        <p class="margin right-align medium-small"><a href="#">Forgot password ?</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('page-js')
    <script>
        $("#registrationForm").validate({
            rules: {
                first_name: 'required',
                last_name: 'required',
                username: 'required',
                email: {
                    required: true,
                    email: true
                },
                password: 'required',
                cpassword: {
                    required: true,
                    equalTo: "#password"
                },
                mobile_num: {
                    required: true,
                    minlength: 9,
                    maxlength: 10,
                    number: true
                },
            },
            //For custom messages
            messages: {
                first_name: "Please enter your first name..!",
                last_name: "Please enter your last name..!",
                username: "Please enter your username..!",
                email: "Please enter your email..!",
                password: "Please enter your password..!",
                cpassword: "Password does not match..!",
                mobile_num: "Enter your mobile number..!",
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $(".js-example-basic-multiple").change(function(){
		    $(".types").val($(this).val());
	    });
    </script>
@endsection
