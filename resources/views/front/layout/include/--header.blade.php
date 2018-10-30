<style>
    #user-info-opntop{
            display:none;
        }
        
</style>
<div id="header" class="header">
    <div class="top-header" style="background:#2874f0;">
        <div class="container">
            <div class="nav-top-links">
                <!--<a class="first-item" href="#">Welcome to LozyPay</a>-->
                <a href="#" style="color:#fff">Call Us: +91 9876543210</a>
                <a class="" href="{{ route('login') }}" style="color:#fff">Login as seller</a>
            </div>
            <!--<div class="support-link">
                <a href="#">Services</a>
                <a href="#">Support</a>
            </div>-->
            @include('front.layout.include.user_top_info')
        </div>
    </div>
    <!--/.top-header -->
    <!-- MAIN HEADER -->
    <div id="main-header">
        <div class="container main-header">
            <div class="row">
                <div class="col-xs-12 col-sm-3 logo">
                    <a href="{{ route('get:homepage') }}"><img alt="LozyPay"
                                                               src="{{ asset('img/lozypay.png') }}"/></a>
                </div>
                <div id="main-menu" class="col-sm-12 col-md-7 main-menu">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                        data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <a class="navbar-brand" href="#">MENU</a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li class="active"><a href="#">Home</a></li>
                                    @foreach($topCategories as $topCategory)
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle"
                                               data-toggle="dropdown">{{ ucwords($topCategory->name) }}</a>
                                            @if(count($topCategory->subCategories()->get())>0)
                                                <ul class="mega_dropdown dropdown-menu"
                                                    style="width: 700px; left: 0px;">
                                                    <li class="block-container col-sm-9">
                                                        <ul class="block">
                                                            @foreach($topCategory->subCategories()->get() as $subcategory)
                                                                <li class="link_container col-sm-4"><a
                                                                            href="{{ route('get:sub_category_products', ['cat' => $topCategory->slug, 'subCatSlug' => $subcategory->slug]) }}">{{ $subcategory->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    @if($topCategory->other_image)
                                                        <li class="block-container col-sm-3">
                                                            <ul class="block">
                                                                <li class="img_container">
                                                                    <img src="{{ asset('category/'.$topCategory->other_image) }}"
                                                                         alt="Banner">
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    @endif
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                    {{--<li><a href="#">Blog</a></li>--}}
                                </ul>
                            </div><!--/.nav-collapse -->
                        </div>
                    </nav>
                </div>
                <div id="cart-block" class="col-xs-5 col-sm-2 col-md-2 shopping-cart-box">
                    @include('front.auth.layout.include.cart')
                </div>
            </div>

        </div>
    </div>
    <!--Middle Header-->
@yield('recharge-panel')
<!-- END MANIN HEADER -->
    <div class="nav-top-menu" style="border:none;">
        <div class="container" style="border-top: 1px solid #cccccc5e;
     border-bottom: 1px solid #cccccc5e;">
            <div class="row">
                <div class="col-sm-3" id="box-vertical-megamenus">
                    <div class="box-vertical-megamenus">
                        <h4 class="title">
                            <span class="title-menu">Categories</span>
                            <span class="btn-open-mobile pull-right home-page"><i class="fa fa-bars"></i></span>
                        </h4>
                        <div class="vertical-menu-content is-home">
                            <ul class="vertical-menu-list">
                                <?php $count = 1 ?>
                                @foreach($categories as $category)
                                    <li class="@if($count > 11) cat-link-orther @endif">
                                        <a href="#"
                                           class="@if(count($category->subCategories()->get())>0) parent @endif">
                                            @if($category->cat_img)
                                                <img class="icon-menu" alt="{{ $category->cat_img }}"
                                                     src="{{ asset('category/'.$category->cat_img) }}">
                                            @endif
                                            {{ $category->name }}
                                        </a>
                                        @if(count($category->subCategories()->get())>0)
                                            <div class="vertical-dropdown-menu">
                                                <div class="vertical-groups col-sm-12">
                                                    <div class="mega-group col-sm-4">
                                                        <h4 class="mega-group-header"><span>Sub Category</span></h4>
                                                        <ul class="group-link-default">
                                                            @foreach($category->subCategories()->get() as $subCategory)
                                                                <li>
                                                                    <a href="{{ route('get:sub_category_products', ['cat' => $category->slug, 'subCatSlug' => $subCategory->slug]) }}">{{ $subCategory->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    @if($category->other_image)
                                                        <div class="mega-custom-html col-sm-12">
                                                            @if(\File::exists(public_path('699CategoryImg/'.$category->sidebar_image)))
                                                                <a href="#">
                                                                    <img src="{{ asset('699CategoryImg/'.$category->sidebar_image) }}"
                                                                         alt="{{ $category->sidebar_image }}"></a>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </li>
                                    <?php $count++ ?>
                                @endforeach
                            </ul>
                            @if(count($categories)>11)
                                <div class="all-category"><span class="open-cate">All Categories</span></div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 col-md-9 formsearch-option4">
                    <form class="form-inline" action="{{ route('get:product_search') }}" id="searchForm" method="get">
                        <div class="form-group form-category">
                            <select class="select-category" name="category">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group input-serach">
                            <input type="text" name="search" id="autocomplete" placeholder="Search...">
                        </div>
                        <button type="submit" class="pull-right btn-search"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                {{--<div class="col-sm-4 col-md-2 group-link-main-menu">--}}
                    {{--<div class="language link-mainmenu">--}}
                        {{--<div class="dropdown">--}}
                            {{--<a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"--}}
                               {{--href="#">--}}
                                {{--<img alt="email" src="{{ asset('front/') }}/assets/images/fr.jpg"/>French--}}
                            {{--</a>--}}
                            {{--<ul class="dropdown-menu" role="menu">--}}
                                {{--<li><a href="#"><img alt="email" src="{{ asset('front/') }}/assets/images/en.jpg"/>English</a>--}}
                                {{--</li>--}}
                                {{--<li><a href="#"><img alt="email" src="{{ asset('front/') }}/assets/images/fr.jpg"/>French</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="currency link-mainmenu">--}}
                        {{--<div class="dropdown">--}}
                            {{--<a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"--}}
                               {{--href="#">USD</a>--}}
                            {{--<ul class="dropdown-menu" role="menu">--}}
                                {{--<li><a href="#">Dollar</a></li>--}}
                                {{--<li><a href="#">Euro1</a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>