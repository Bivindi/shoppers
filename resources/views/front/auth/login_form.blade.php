<div class="modal fade bd-example-modal-lg2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="container">
                <div class="row text-left">
                    <div class="col-md-12 p0">

                        <div class="modal-tab-section wd-modal-tabs">
                            <ul class="nav nav-tabs wd-modal-tab-menu text-center" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-expanded="true">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="sign-up-tab" data-toggle="tab" href="#sign-up" role="tab" aria-controls="sign-up">Sign up</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">

                                    <div class="row">
                                        <div class="col-md-6 p0 brand-description-area">
                                            <img src="{{ asset('front/img/login-img-1.jpg') }}" class="img-fluid" alt="">
                                            <div class="brand-description">
                                                <div class="brand-logo">
                                                    <img src="{{ asset('front/img/logo.png') }}" alt="Logo">
                                                </div>
                                                <div class="modal-description">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod teoccaecvoluptatem.</p>
                                                </div>
                                                <ul class="list-unstyled">
                                                    <li class="media">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        <div class="media-body">
                                                            Lorem ipsum dolor sit amet, consecadipisicing elit, sed do eiusmod teoccaecvoluptatem.
                                                        </div>
                                                    </li>
                                                    <li class="media my-4">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        <div class="media-body">
                                                            Lorem ipsum dolor sit amet, consecadipisicing elit, sed do eiusmod teoccaecvoluptatem.
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        <div class="media-body">
                                                            Lorem ipsum dolor sit amet, consecadipisicing elit, sed do eiusmod teoccaecvoluptatem.
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6 p0">
                                            <div class="login-section text-center">
                                                <div class="social-media">
                                                    <a href="#" id="google_login"  class="facebook-bg"><i class="fa fa-facebook" aria-hidden="true"></i> Login</a>

                                                    <a href="#" id="facebook_login" class="google-bg"><i class="fa fa-google-plus" aria-hidden="true"></i> Login</a>
                                                </div>
                                                <div class="login-form text-left">
                                                    <form id="loginForm">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <label for="exampleInputEmaillogin">User name OR mobile</label>
                                                            <input class="form-control" type="text" required placeholder="Username OR Mobile" name="username_or_mobile" value="{{ old('username_or_mobile') }}"><span class="error username_or_mobile"></span>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputPasswordlogin">Password</label>
                                                            <input class="form-control" required type="password" placeholder="Password" name="password"><span class="error error_password"></span>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary wd-login-btn loginBtn">LOGIN</button>
                                                    </form>
                                                    <div class="wd-policy">
                                                        <p>
                                                            Looking to . <a href="javascript: showRegisterForm();" class="loginpop register_form">create an account</a> | ?&nbsp;&nbsp;<a href="javascript: showForgotForm();" class="loginpop forgot_password">Forgot Password |</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="sign-up" role="tabpanel" aria-labelledby="sign-up-tab">

                                    <div class="row">
                                        <div class="col-md-6 p0 brand-login-section">
                                            <img src="{{ asset('front/img/login-img-2.jpg') }}" class="img-fluid" alt="">
                                            <div class="brand-description">
                                                <div class="brand-logo">
                                                    <img src="{{ asset('front/img/logo.png') }}" alt="Logo">
                                                </div>
                                                <div class="modal-description">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod teoccaecvoluptatem.</p>
                                                </div>
                                                <ul class="list-unstyled">
                                                    <li class="media">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        <div class="media-body">
                                                            Lorem ipsum dolor sit amet, consecadipisicing elit, sed do eiusmod teoccaecvoluptatem.
                                                        </div>
                                                    </li>
                                                    <li class="media my-4">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        <div class="media-body">
                                                            Lorem ipsum dolor sit amet, consecadipisicing elit, sed do eiusmod teoccaecvoluptatem.
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        <div class="media-body">
                                                            Lorem ipsum dolor sit amet, consecadipisicing elit, sed do eiusmod teoccaecvoluptatem.
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p0">
                                            <div class="sign-up-section text-center">
                                                <div class="login-form text-left">
                                                    <form id="registrationForm">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <label>First name</label>
                                                            <input class="form-control" type="text" required placeholder="First Name" name="first_name"><span class="error first_name_error"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Last name</label>
                                                            <input class="form-control" type="text" required placeholder="Last Name" name="last_name"><span class="error last_name_error"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Username</label>
                                                            <input class="form-control" type="text" required placeholder="Username" name="username"><span class="error username_error"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input class="form-control" type="email" required placeholder="Email" name="email"><span class="error email_error"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Password</label>
                                                            <input id="pwd" class="form-control" type="password" required placeholder="Password" name="password"><span class="error password_error"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Repeat Password</label>
                                                            <input class="form-control" type="password" placeholder="Repeat Password" required name="cpassword"><span class="error cpassword_error"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Mobile Number</label>
                                                            <input class="form-control" type="number" placeholder="Mobile Number" name="mobile_num" required><span class="error mobile_num_error"></span>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary wd-login-btn submitBtn">Sign Up</button>

                                                        <div class="wd-policy">
                                                            <p>
                                                                Already have an account?<a href="javascript: showLoginForm();" class="loginpop login_form">&nbsp;&nbsp;Login</a> |
                                                            </p>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane fade" id="forgot_password" role="tabpanel" aria-labelledby="forgot_password-tab">

                                    <div class="row">
                                        <div class="col-md-6 p0 brand-description-area">
                                            <img src="{{ asset('front/img/login-img-1.jpg') }}" class="img-fluid" alt="">
                                            <div class="brand-description">
                                                <div class="brand-logo">
                                                    <img src="{{ asset('front/img/logo.png') }}" alt="Logo">
                                                </div>
                                                <div class="modal-description">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod teoccaecvoluptatem.</p>
                                                </div>
                                                <ul class="list-unstyled">
                                                    <li class="media">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        <div class="media-body">
                                                            Lorem ipsum dolor sit amet, consecadipisicing elit, sed do eiusmod teoccaecvoluptatem.
                                                        </div>
                                                    </li>
                                                    <li class="media my-4">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        <div class="media-body">
                                                            Lorem ipsum dolor sit amet, consecadipisicing elit, sed do eiusmod teoccaecvoluptatem.
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        <div class="media-body">
                                                            Lorem ipsum dolor sit amet, consecadipisicing elit, sed do eiusmod teoccaecvoluptatem.
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6 p0">
                                            <div class="login-section text-center">
                                                <!-- <div class="social-media">
                                                    <a href="#" id="google_login"  class="facebook-bg"><i class="fa fa-facebook" aria-hidden="true"></i> Login</a>

                                                    <a href="#" id="facebook_login" class="google-bg"><i class="fa fa-google-plus" aria-hidden="true"></i> Login</a>
                                                </div> -->
                                                <div class="login-form text-left">
                                                    <form id="forgotForm">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <label for="exampleInputEmaillogin">Email</label>
                                                            <input class="form-control" type="email" required placeholder="Email" name="email"><span class="error email_error"></span>
                                                        </div>  
                                                        <button type="submit" class="btn btn-primary wd-login-btn submitBtn">Submit</button>
                                                    </form>
                                                    <div class="wd-policy">
                                                        <p>
                                                            Looking to . <a href="javascript: showRegisterForm();" class="loginpop register_form">create an account</a> | ?&nbsp;&nbsp;<a href="javascript: showForgotForm(); forgot_password" class="loginpop">Forgot Password |</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>