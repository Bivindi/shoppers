<style>
    .loginpop {
        color: #797979 !important;
    }

    .loginpop:hover {
        color: #ff2666 !important;
    }
</style>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Login with</h4>
</div>
<div class="modal-body">
    <div class="box">
        <div class="content">
            <div class="social">
                <a id="google_login" class="circle google" href="#">
                    <i class="fa fa-google-plus fa-fw"></i>
                </a>
                <a id="facebook_login" class="circle facebook" href="#">
                    <i class="fa fa-facebook fa-fw"></i>
                </a>
            </div>
            <div class="division">
                <div class="line l"></div>
                <span>or</span>
                <div class="line r"></div>
            </div>
            <div class="error"></div>
            <div class="form loginBox">
                <form id="loginForm">
                    {{ csrf_field() }}
                    <input class="form-control" type="text" required placeholder="Username OR Mobile"
                           name="username_or_mobile" value="{{ old('username_or_mobile') }}">
                    <span class="error username_or_mobile"></span>
                    <input class="form-control" required type="password" placeholder="Password"
                           name="password">
                    <span class="error error_password"></span>
                    <button class="btn btn-default btn-login loginBtn">Login</button>
                </form>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="content registerBox" style="display:none;">
            <div class="form">
                <form id="registrationForm">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-6">
                            <input class="form-control" type="text" required placeholder="First Name"
                                   name="first_name">
                            <span class="error first_name_error"></span>
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" required placeholder="Last Name"
                                   name="last_name">
                            <span class="error last_name_error"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <input class="form-control" type="text" required placeholder="Username"
                                   name="username">
                            <span class="error username_error"></span>
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control" type="email" required placeholder="Email"
                                   name="email">
                            <span class="error email_error"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <input id="pwd" class="form-control" type="password" required placeholder="Password"
                                   name="password">
                            <span class="error password_error"></span>
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control" type="password"
                                   placeholder="Repeat Password" required name="cpassword">
                            <span class="error cpassword_error"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="form-control" type="number"
                                   placeholder="Mobile Number"
                                   name="mobile_num" required>
                            <span class="error mobile_num_error"></span>
                        </div>
                    </div>
                    <button class="btn btn-default btn-register submitBtn">Create account</button>
                </form>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="content forgotBox" style="display:none;">
            <div class="form">
                <form id="forgotForm">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-12">
                            <input class="form-control" type="email" required placeholder="Email"
                                   name="email">
                            <span class="error email_error"></span>
                        </div>
                    </div>
                    <button class="btn btn-default btn-register submitBtn">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="forgot login-footer">
                            <span>Looking to
                                 <a href="javascript: showRegisterForm();" class="loginpop">create an account</a>
                            ?</span>
        <a href="javascript: showForgotForm();" class="loginpop">Forgot Password</a>
    </div>
    <div class="forgot register-footer" style="display:none">
        <span>Already have an account?</span>
        <a href="javascript: showLoginForm();" class="loginpop">Login</a>
    </div>
</div>
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
                equalTo: "#pwd"
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
                $(placement).append(error);
                $(".submitBtn").addClass('shakeBtn');
            } else {
                error.insertAfter(element);
                $(".submitBtn").addClass('shakeBtn');
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
                $(placement).append(error);
                $(".loginBtn").addClass('shakeBtn');
            } else {
                error.insertAfter(element);
                $(".loginBtn").addClass('shakeBtn');
            }
        }
    });

    $(document).on('submit', '#forgotForm', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: "{{ route('post:forgot_password_mail') }}",
            data: $(this).serialize(),
            beforeSend: function () {
                $(".submitBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw text-center"></i>');
                $(".submitBtn").attr('disabled', true);
            },
            success: function (result) {
                if (result.success == true) {
                    $('#loginModal').modal('hide');
                    $('#forgotForm')[0].reset();
                    $(".submitBtn").html('Submit');
                    $(".submitBtn").attr('disabled', false);
                    location.reload();
                }
                if (result.success == false) {
                    $.notify(result.message, "error");
                    shakeModal();
                    $(".submitBtn").html('Submit');
                    $(".submitBtn").attr('disabled', false);
                }
                if (result.error == true) {
                    $.each(result.message, function (index, error) {
                        var keys = Object.keys(result.message);
                        $('input[name="' + keys[0] + '"]').focus();
                        $('.' + index + '_error').html(error);
                    });
                    shakeModal();
                    $(".submitBtn").html('Submit');
                    $(".submitBtn").attr('disabled', false);
                }
            }
        });
    });
</script>