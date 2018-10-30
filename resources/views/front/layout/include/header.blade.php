





<!-- =========================
        Header Top Section
    ============================== -->
<section id="wd-header-top">
    <div class="container-fluid custom-width">
        <div class="row">
            <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                <!-- =========================
                        Social Media List
                    ============================== -->
                <div class="wb-social-media">
                    <a href="#" class="bh"><i class="fa fa-behance"></i></a>
                    <a href="#" class="fb"><i class="fa fa-facebook-official"></i></a>
                    <a href="#" class="db"><i class="fa fa-dribbble"></i></a>
                    <a href="#" class="gp"><i class="fa fa-google-plus"></i></a>
                    <a href="#" class="vn"><i class="fa fa-vine"></i></a>
                    <a href="#" class="yt"><i class="fa fa-youtube-play"></i></a>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-5 col-xl-6 d-none d-md-block">
                <div class="offer-text text-center">
                    <p class="text-uppercase">upto 50% off to all virtual products</p>
                </div>
            </div>

            <!-- =========================
                    Select Country and Language
                ============================== -->
            <div class="col-6 col-sm-6 col-md-4  col-lg-3 col-xl-3">
                <div class="language-and-currency-btn">

                    <img src="{{ asset('front/img/flag-icon.jpg') }}" alt="flag-icon">
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop3" type="button" class="btn btn-secondary wd-btn-country dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                English
                            </button>
                            <div class="dropdown-menu wd-btn-country-list" aria-labelledby="btnGroupDrop3">
                                <a class="dropdown-item" href="#"><img src="{{ asset('front/img/flag-icon-2.png') }}" alt="flag-icon"> Bangla</a>
                                <a class="dropdown-item" href="#"><img src="{{ asset('front/img/flag-icon-3.png' )}}" alt="flag-icon"> Spanish</a>
                            </div>
                        </div>
                    </div>

                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop4" type="button" class="btn btn-secondary wd-btn-language dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Currency
                            </button>
                            <div class="dropdown-menu wd-btn-language-list" aria-labelledby="btnGroupDrop4">
                                <a class="dropdown-item" href="#">&#36; Dollar</a>
                                <a class="dropdown-item" href="#">&#163; Pound</a>
                                <a class="dropdown-item" href="#">&#8364; Euro</a>
                            </div>
                        </div>
                    </div>

                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <a href="{{ url('admin/login') }}" id="btnGroupDrop3" type="button" class="btn btn-secondary wd-btn-country">
                                Sell with us
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =========================
        Header Section
    ============================== -->
<section id="wd-header">
    <div class="container-fluid custom-width">
        <div class="row">
            <div class="col-md-12 col-lg-3 col-xl-3 text-center second-home-main-logo">
                <a href="{{ url('') }}"><img src="{{ asset('front/img/logo.png') }}" alt="Logo"></a>
            </div>
            @include('front.layout.include.search_form')
            
            <div class="col-md-6 col-lg-3  col-xl-3 text-right">
                @if(Auth::check())
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop4" type="button" class="btn btn-secondary wd-btn-language dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: #fff;color: #666;border: 0;">
                                @if(Auth::check()) Hello {{ Auth::user()->username }} @endif
                            </button>
                            <div class="dropdown-menu wd-btn-language-list" aria-labelledby="btnGroupDrop4">
                                @if(Auth::check())
                                    <a class="dropdown-item" href="{{ route('get:user_profile') }}" onclick="location.href = '{{ route('get:user_profile') }}';">Profile</a>
                                    <a class="dropdown-item" href="{{ route('get:compare') }}">Compare</a>
                                    <a class="dropdown-item"  href="{{ route('get:wish_list') }}">{{ Auth::user()->wishlistedProductCount() }} Wishlists</a>
                                    <a class="dropdown-item" href="{{ route('get:your_orders') }}">Order </a>
                                    <a class="dropdown-item" href="{{ route('get:wallet') }}">Wallet </a>
                                    <a class="dropdown-item" href="{{ route('get:user_logout') }}">Logout</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <button class="btn btn-primary my-account d-none d-lg-block" data-toggle="modal" data-target=".bd-example-modal-lg2">
                        <i class="fa fa-user" aria-hidden="true"></i> My account
                    </button>
                    @include('front.auth.login_form')
                @endif
                
            </div>
        </div>
    </div>
</section>

<!-- =========================
        Header Section
    ============================== -->
<section id="wd-header-2" class="wd-header-nav sticker-nav mob-sticky">
    <div class="container-fluid custom-width">
        <div class="row">
            <div class="col-md-8 col-2 col-sm-6 col-md-4 d-block d-lg-none">
                <div class="accordion-wrapper hide-sm-up">
                    <a href="#" class="mobile-open"><i class="fa fa-bars" ></i></a>
                    <!--Mobile Menu start-->

                    <ul id="mobilemenu" class="accordion">
                        <!-- <li class="mob-logo"><a href="index.html"><img src="{{ asset('front/img/logo.png') }}" alt=""></a></li>-->
                        <li><a class="closeme" href="#"><i class="fa fa-times" ></i></a></li>
                        <li class="mob-logo">
                            <a href="{{ url('') }}"><img src="{{ asset('front/img/logo.png') }}" alt=""></a>
                        </li>

                        <li class="out-link"><a class="" href="{{ url('') }}">Home</a></li>
                        @foreach($topCategories as $topCategory)
                            <li>
                                @if(count($topCategory->subCategories()->get())>0)
                                    <div class="link">{{ ucwords($topCategory->name) }}<i class="fa fa-chevron-down"></i></div>
                                    <ul class="submenu font-sky">
                                        @foreach($topCategory->subCategories()->get() as $subcategory)
                                            <li><a href="{{ route('get:sub_category_products', ['cat' => $topCategory->slug, 'subCatSlug' => $subcategory->slug]) }}">{{ $subcategory->name }}</a></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <a class="" href="#">{{ ucwords($topCategory->name) }}</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <!--Mobile Menu end-->
                </div>
            </div>
            <!--Mobile menu end-->
            <div class="col-xl-3 d-none d-xl-block">
            @if(Request::url() === url(''))
                <div class="department">
                    <img src="{{ asset('front/img/menu-bar.png') }}" alt="menu-bar"> All Categories
                    <div class="shape-img">
                        <img src="{{ asset('front/img/department-shape-img.png') }}" class="img-fluid" alt="department img">
                    </div>
                    <div id="department-list" class="department-list">
                        <ul class="list-group">
                            <?php $count = 1 ?>
                            @foreach($categories as $category)
                            <li class="list-group-item">
                                <a href="#">
                                    <div class="department-list-logo">
                                        @if($category->cat_img)
                                            <img src="{{ asset('category/'.$category->cat_img) }}" alt="{{ $category->cat_img }}">
                                        @endif
                                    </div>
                                    <span class="sub-list-main-menu">{{ $category->name }}</span> @if(count($category->subCategories()->get())>0)<i class="fa fa-angle-right" aria-hidden="true"></i>@endif
                                </a>
                                @if(count($category->subCategories()->get())>0)
                                    <div class="wd-sub-list">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h6 class="black-color wd-sub-list-title">Sub Category</h6>
                                                    <ul class="wd-sub-menu nav">
                                                        @foreach($category->subCategories()->get() as $subCategory)
                                                            <li style="width: 33.33%"><a href="{{ route('get:sub_category_products', ['cat' => $category->slug, 'subCatSlug' => $subCategory->slug]) }}">{{ $subCategory->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <!-- <div class="col-md-6">
                                                    <a href="product-details-scroll.html"><img src="{{ asset('front/img/department-img/department-sub-list-img-1.jpg') }}" class="department-sub-list-img" alt="department-sub-list-img"></a>
                                                </div>
                                                <div class="col-md-6">
                                                    <a href="product-details-scroll.html"><img src="{{ asset('front/img/department-img/department-sub-list-img-2.jpg') }}" class="department-sub-list-img" alt="department-sub-list-img"></a>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            </div>
            <div class="col-md-6 col-lg-10 col-xl-7 header-search-box d-none d-lg-block">
                <div id="main-menu-2" class="main-menu-desktop no-border main-menu-sh">
                    <div class="menu-container wd-megamenu text-left">
                        <div class="menu">
                            <ul class="wd-megamenu-ul">
                                <li><a href="{{ url('') }}" class="main-menu-list"><i class="fa fa-home" aria-hidden="true"></i> Home </a>
                                </li>
                                @foreach($topCategories as $topCategory)
                                    <li><a href="#" class="main-menu-list">{{ ucwords($topCategory->name) }} 
                                        @if(count($topCategory->subCategories()->get())>0)
                                            <i class="fa fa-angle-down angle-down" aria-hidden="true"></i>
                                        @endif
                                        </a>
                                        @if(count($topCategory->subCategories()->get())>0)
                                            <ul class="single-dropdown">
                                                @foreach($topCategory->subCategories()->get() as $subcategory)
                                                    <li><a href="{{ route('get:sub_category_products', ['cat' => $topCategory->slug, 'subCatSlug' => $subcategory->slug]) }}">{{ $subcategory->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10 col-sm-6 col-md-4 col-lg-2 col-xl-2 text-right">
                <!-- =========================
                             Cart Out 
                        ============================== -->

                <div class="header-cart">
                    <div class="account-section d-md-block d-lg-none">
                        <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg2">
                            <i class="fa fa-sign-in" aria-hidden="true"></i><span>Login/Register</span>
                        </button>
                        @include('front.auth.login_form')
                        <div class="modal fade bd-example-modal-lg21" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                            <a href="#" class="facebook-bg"><i class="fa fa-facebook" aria-hidden="true"></i> Login</a>
                                                                            <a href="#" class="twitter-bg"><i class="fa fa-twitter" aria-hidden="true"></i> Login</a>
                                                                            <a href="#" class="google-bg"><i class="fa fa-google-plus" aria-hidden="true"></i> Login</a>
                                                                        </div>
                                                                        <div class="login-form text-left">
                                                                            <form>
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail-login">User name</label>
                                                                                    <input type="text" class="form-control" id="exampleInputEmail-login" placeholder="John mist |">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputPassword-login-pass-2">Password</label>
                                                                                    <input type="password" class="form-control" id="exampleInputPassword-login-pass-2" placeholder="*** *** ***">
                                                                                </div>
                                                                                <button type="submit" class="btn btn-primary wd-login-btn">LOGIN</button>

                                                                                <div class="form-check">
                                                                                    <label class="form-check-label">
                                                                                        <input type="checkbox" class="form-check-input"> Save this password
                                                                                    </label>
                                                                                </div>

                                                                                <div class="wd-policy">
                                                                                    <p>
                                                                                        By Continuing. I conferm that i have read and userstand the <a href="#">terms of uses</a> and <a href="#">Privacy Policy</a>. Don’t have an account? <a href="#" class="black-color"><strong><u>Sign up</u></strong></a>
                                                                                    </p>
                                                                                </div>
                                                                            </form>
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
                                                                            <form>
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputname1">First name</label>
                                                                                    <input type="text" class="form-control" id="exampleInputname1" placeholder="First Name">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputname2">Last name</label>
                                                                                    <input type="text" class="form-control" id="exampleInputname2" placeholder="Last Name">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputEmail-sign-up">Email</label>
                                                                                    <input type="text" class="form-control" id="exampleInputEmail-sign-up" placeholder="Enter you email ...">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="exampleInputPassword-login-pass">Password</label>
                                                                                    <input type="password" class="form-control" id="exampleInputPassword-login-pass" placeholder="*** *** ***">
                                                                                </div>
                                                                                <button type="submit" class="btn btn-primary wd-login-btn">Sign Up</button>

                                                                                <div class="wd-policy">
                                                                                    <p>
                                                                                        By Continuing. I conferm that i have read and userstand the <a href="#">terms of uses</a> and <a href="#">Privacy Policy</a>. Don’t have an account? <a href="#" class="black-color"><strong><u>Sign up</u></strong></a>
                                                                                    </p>
                                                                                </div>
                                                                            </form>
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
                    <div class="serch-wrapper">
                        <div class="search">
                            <input class="search-input" placeholder="Search" type="text">
                            <a href="javascript:void(0)"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="header-cart">
                        <a href="coupon.html" class="coupon-save"><i class="fa fa-star-o" aria-hidden="true"></i>
                            <span class="count">5</span>
                        </a>

                        <a class="header-wishlist" href="wishlist.html">
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                            <span class="count">8</span>
                        </a>
                    
                        <a class="header-wishlist" href="{{ route('get:compare') }}">
                            <i class="fa fa-balance-scale"></i>
                            
                        </a>
                        @include('front.auth.layout.include.cart')
					</div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</section>