@extends('front.auth.layout.default')
@section('title')
    Login
@endsection
@section('page-content')
    <div class="columns-container">
        <div class="container" id="columns">
            <!-- breadcrumb -->
            <div class="breadcrumb clearfix">
                <a class="home" href="#" title="Return to Home">Home</a>
                <span class="navigation-pipe">&nbsp;</span>
                <span class="navigation_page">Authentication</span>
            </div>
            <!-- ./breadcrumb -->
            <!-- page heading-->
            <h2 class="page-heading">
                <span class="page-heading-title2">Authentication</span>
            </h2>
            <!-- ../page heading-->
            <div class="page-content">
                <div class="row">
                    <form id="registrationForm">
                        {{ csrf_field() }}
                        <div class="col-sm-6">
                            <div class="box-authentication">
                                <h3>Create an account</h3>
                                <p>Please enter your email address to create an account.</p>
                                <label for="first_name">First Name</label>
                                <input id="first_name" name="first_name" value="{{ old('first_name') }}" type="text"
                                       class="form-control">
                                <span class="error first_name_error"></span>
                                <label for="last_name">Last Name</label>
                                <input id="last_name" name="last_name" value="{{ old('last_name') }}" type="text"
                                       class="form-control">
                                <span class="error last_name_error"></span>
                                <label for="username">Username</label>
                                <input id="username" name="username" value="{{ old('username') }}" type="text"
                                       class="form-control">
                                <span class="error username_error"></span>
                                <label for="emmail_register">Email address</label>
                                <input id="emmail_register" name="email" value="{{ old('email') }}" type="email"
                                       class="form-control">
                                <span class="error email_error"></span>
                                <label for="password">Password</label>
                                <input id="password" name="password" type="password" class="form-control">
                                <span class="error password_error"></span>
                                <label for="cpassword">Confirmation Password</label>
                                <input id="cpassword" name="cpassword" type="password" class="form-control">
                                <span class="error cpassword_error"></span>
                                <label for="mobile">Mobile Number</label>
                                <input id="mobile" name="mobile_num" value="{{ old('mobile_num') }}" type="text"
                                       class="form-control">
                                <span class="error mobile_num_error"></span>
                                <button type="submit" class="button submitBtn"><i class="fa fa-user"></i> Create an
                                    account
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="col-sm-6">
                        <div class="box-authentication">
                            <h3>Already registered?</h3>
                            <form id="loginForm">
                                {{ csrf_field() }}
                                <label for="loginUsername">Username or Mobile Number</label>
                                <input id="loginUsername" type="text" name="username_or_mobile" class="form-control">
                                <span class="error username_or_mobile"></span>
                                <label for="password_login">Password</label>
                                <input id="password_login" name="password" type="password" class="form-control">
                                <span class="error error_password"></span>
                                <p class="forgot-pass"><a href="#">Forgot your password?</a></p>
                                <button type="submit" class="button loginBtn"><i class="fa fa-lock"></i> Sign in
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script>
        $(document).on('submit', '#registrationForm', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: "{{ route('post:user_register') }}",
                data: $(this).serialize(),
                beforeSend: function () {
                    $(".submitBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                    $(".submitBtn").attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        $('#registrationForm')[0].reset();
                        $(".submitBtn").html('Create an account');
                        $(".submitBtn").attr('disabled', false);
                        window.location.href = '{{ route('get:homepage') }}';
                    }
                    if (result.error == true) {
                        $.each(result.message, function (index, error) {
                            var keys = Object.keys(result.message);
                            $('input[name="' + keys[0] + '"]').focus();
                            console.log('.' + index + '_error');
                            $('.' + index + '_error').html(error);
                        });
                        $(".submitBtn").html('Create an account');
                        $(".submitBtn").attr('disabled', false);
                    }
                }
            });
        });

        $(document).on('submit', '#loginForm', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: "{{ route('post:user_login') }}",
                data: $(this).serialize(),
                beforeSend: function () {
                    $(".loginBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                    $(".loginBtn").attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        $('#loginForm')[0].reset();
                        $(".loginBtn").html('Sign in');
                        $(".loginBtn").attr('disabled', false);
                        window.location.href = result.url;
                    }
                    if (result.error == true) {
                        $.each(result.message, function (index, error) {
                            var keys = Object.keys(result.message);
                            $('input[name="' + keys[0] + '"]').focus();
                            $('.' + index + '_error').html(error);
                        });
                        $(".loginBtn").html('Sign in');
                        $(".loginBtn").attr('disabled', false);
                    }
                }
            });
        });


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
                mobile_num: "Enter your mobile number..!"
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

        $("#loginForm").validate({
            rules: {
                username_or_mobile: 'required',
                password: 'required',
            },
            //For custom messages
            messages: {
                username_or_mobile: "Please enter your username or mobile number..!",
                password: "Please enter your password..!",
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
    </script>
@endsection