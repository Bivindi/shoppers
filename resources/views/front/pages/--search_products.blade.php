@extends('front.auth.layout.default')
@section('page-css')
    <style>
        .block-quickview {
            padding: 15px;
            background: #fff;
        }

        .fa {
            line-height: inherit !important;
        }

        .wishlist {
            cursor: pointer;
        }

        .wishlisted {
            background-color: red !important;
        }

        .compare-btn {
            font-size: 14px;
            border-radius: 2px;
            color: #fff;
            position: fixed;
            bottom: 20px;
            left: 15px;
            cursor: pointer;
            font-weight: 500;
            height: 40px;
            width: 144px;
            background-color: #ff2666;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .2);
            z-index: 10000;
        }

        .compare-filed {
            position: fixed;
            bottom: 20px;
            right: 15px;
            z-index: 10000;
        }

        .G934d8 {
            display: inline-block;
            padding-left: 24px;
            padding-top: 10px;
        }

        ._1j7Tzv {
            display: inline-block;
            position: relative;
        }

        .compare-cont {
            position: absolute;
            top: 10px;
            margin-left: 14px;
            border-radius: 2px;
            background-color: rgba(0, 0, 0, .2);
            padding: 0;
            pointer-events: none;
            display: inline-block;
            height: 20px;
            width: 20px;
            text-align: center;
        }

        .paragraph-end {
            background-image: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(255, 255, 255, 0)), color-stop(100%, rgba(255, 255, 255, 1)));
            background-image: -webkit-linear-gradient(left, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
            background: linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
            filter: progid:DXImageTransform.Microsoft.gradient(GradientType=1, StartColorStr='#00ffffff', EndColorStr='#ffffff');
            bottom: 38px;
            height: 20px;
            max-height: 100%;
            position: absolute;
            right: 17px;
            width: 39px;
        }

        .fixed {
            position: fixed;
        }
    </style>
@endsection
@section('title')
    {{ $data }} Products
@endsection
@section('body-class')
    class="category-page"
@endsection
@section('page-content')
    <div class="columns-container">
        <div class="container" id="columns">
            <!-- breadcrumb -->
            <div class="breadcrumb clearfix">
                <a class="home" href="#" title="Return to Home">Home</a>
                <span class="navigation-pipe">&nbsp;</span>
                <span class="navigation_page">{{ $data }}</span>
            </div>
            <!-- ./breadcrumb -->
            <!-- row -->
            <div class="row">
                <!-- Left colunm -->
                <div class="column col-xs-12 col-sm-3" id="left_column">
                    <!-- block category -->
                {{--<div class="block left-module">--}}
                {{--<p class="title_block">Product types</p>--}}
                {{--<div class="block_content">--}}
                {{--<!-- layered -->--}}
                {{--<div class="layered layered-category">--}}
                {{--<div class="layered-content">--}}
                {{--<ul class="tree-menu">--}}
                {{--<li class="active">--}}
                {{--<span></span><a href="#">Tops</a>--}}
                {{--<ul>--}}
                {{--<li><span></span><a href="#">T-shirts</a></li>--}}
                {{--<li><span></span><a href="#">Dresses</a></li>--}}
                {{--<li><span></span><a href="#">Casual</a></li>--}}
                {{--<li><span></span><a href="#">Evening</a></li>--}}
                {{--<li><span></span><a href="#">Summer</a></li>--}}
                {{--<li><span></span><a href="#">Bags & Shoes</a></li>--}}
                {{--<li><span></span><a href="#"><span></span>Blouses</a></li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                {{--<li><span></span><a href="#">T-shirts</a></li>--}}
                {{--<li><span></span><a href="#">Dresses</a></li>--}}
                {{--<li><span></span><a href="#">Jackets and coats </a></li>--}}
                {{--<li><span></span><a href="#">Knitted</a></li>--}}
                {{--<li><span></span><a href="#">Pants</a></li>--}}
                {{--<li><span></span><a href="#">Bags & Shoes</a></li>--}}
                {{--<li><span></span><a href="#">Best selling</a></li>--}}
                {{--</ul>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<!-- ./layered -->--}}
                {{--</div>--}}
                {{--</div>--}}
                <!-- ./block category  -->
                    <!-- block filter -->
                    
                    <!-- ./block filter  -->

                    <!-- left silide -->
                    <div class="col-left-slide left-module">
                        <ul class="owl-carousel owl-style2" data-loop="true" data-nav="false" data-margin="30"
                            data-autoplayTimeout="1000" data-autoplayHoverPause="true" data-items="1"
                            data-autoplay="true">
                            <li><a href="#"><img src="{{ asset('front/') }}/assets/data/slide-left.jpg"
                                                 alt="slide-left"></a></li>
                            <li><a href="#"><img src="{{ asset('front/') }}/assets/data/slide-left2.jpg"
                                                 alt="slide-left"></a></li>
                            <li><a href="#"><img src="{{ asset('front/') }}/assets/data/slide-left3.png"
                                                 alt="slide-left"></a></li>
                        </ul>

                    </div>
                    <!--./left silde-->
                    <!-- SPECIAL -->
                    <div class="block left-module">
                        <p class="title_block">SPECIAL PRODUCTS</p>
                        <div class="block_content">
                            <ul class="products-block">
                                <li>
                                    <div class="products-block-left">
                                        <a href="#">
                                            <img src="{{ asset('front/') }}/assets/data/product-100x122.jpg"
                                                 alt="SPECIAL PRODUCTS">
                                        </a>
                                    </div>
                                    <div class="products-block-right">
                                        <p class="product-name">
                                            <a href="#">Woman Within Plus Size Flared</a>
                                        </p>
                                        <p class="product-price">$38,95</p>
                                        <p class="product-star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                            <div class="products-block">
                                <div class="products-block-bottom">
                                    <a class="link-all" href="#">All Products</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./SPECIAL -->
                    <!-- TAGS -->
                {{--@include('front.pages.include.tags')--}}
                <!-- ./TAGS -->
                    <!-- Testimonials -->
                    {{--@include('front.pages.include.testimonials')--}}
                </div>
                <!-- ./left colunm -->
                <!-- Center colunm-->
                <div class="center_column col-xs-12 col-sm-9" id="center_column">
                    <!-- view-product-list-->
                    <div id="view-product-list" class="view-product-list">
                        <h2 class="page-heading">
                            <span class="page-heading-title">Search: {{ $data }}</span>
                        </h2>
                        <ul class="display-product-option">
                            <li class="view-as-grid selected">
                                <span>grid</span>
                            </li>
                            <li class="view-as-list">
                                <span>list</span>
                            </li>
                        </ul>
                        <!-- PRODUCT LIST -->
                        <ul class="row product-list grid">
                            @foreach($products as $product)
                                <li class="col-sx-12 col-sm-4">
                                    <div class="product-container">
                                        <div class="left-block">
                                            <a href="{{ route('get:product_detail', $product->slug) }}">
                                                <img class="img-responsive" alt="{{ $product->product_img }}"
                                                     src="{{ asset('300ProdctImg/'.$product->product_img) }}"/>
                                            </a>
                                            <div class="quick-view">
                                                <a title="Add to my wishlist"
                                                   class="heart wishlist @if($product->isWishListProducts()) wishlisted @endif"
                                                   productId="{{ $product->id }}" href="javascript:void(0);"></a>
                                                <a title="Add to compare"
                                                   class="compare compare-product @if($product->iscompareProducts()) wishlisted @endif "
                                                   productId="{{ $product->id }}" href="javascript:void(0);"></a>
                                                <a title="Quick view" class="search" href="javascript:void(0);"
                                                   productId="{{ $product->id }}"></a>
                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" class="btn-add-cart" href="{{ route('get:product_detail', $product->slug) }}">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name">
                                                <a href="{{ route('get:product_detail', $product->slug) }}">{{ mb_strimwidth($product->name, 0, 50, '...') }}</a>
                                                <div class="paragraph-end"></div>
                                            </h5>
                                            <div class="product-star">
                                                <div class="ratiyo-rating"
                                                     data-rating="{{ $product->getAvgRating() }}"></div>
                                            </div>
                                            <div class="content_price">
                                                @if(count($product->getDiscountPrice())>0)
                                                    <span class="price product-price"><i
                                                                class="fa fa-inr"></i>{{ $product->getDiscountPrice() }}</span>
                                                    <span class="price old-price"><i
                                                                class="fa fa-inr"></i>{{ $product->price }}</span>
                                                @else
                                                    <span class="price"><i class="fa fa-inr"></i> {{ $product->price }}</span>
                                                @endif
                                            </div>
                                            <div class="info-orther">
                                                <p class="availability">Availability: <span>@if($product->quantity != 0)
                                                            In stock @else Not In Stock @endif</span></p>
                                                <div class="product-desc">
                                                    {!! mb_strimwidth($product->desc, 0, 100, '...') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <!-- ./PRODUCT LIST -->
                    </div>
                    <!-- ./view-product-list-->
                    <div class="sortPagiBar">
                        <div class="bottom-pagination">
                            <nav>
                                <ul class="pagination">
                                    {{ $products->links() }}
                                </ul>
                            </nav>
                        </div>
                        <div class="sort-product">
                            <select>
                                <option value="">Product Name</option>
                                <option value="">Price</option>
                            </select>
                            <div class="sort-product-icon">
                                <i class="fa fa-sort-alpha-asc"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fency"></div>
    <div class="compare-filed">
        @if(\App\Model\Products::checkCompareProducts() > 0)
            <a class="compare-btn"
               href="{{ route('get:compare') }}"><span class="G934d8"><span>COMPARE</span></span>
                <div class="_1j7Tzv">
                    <span class="compare-cont">{{ \App\Model\Products::checkCompareProducts() }}</span>
                </div>
            </a>
        @endif
    </div>
@endsection
@section('page-js')
    <script>
        $(".ratiyo-rating").each(function () {
            var rating = $(this).attr("data-rating");
            $(this).rateYo(
                {
                    rating: rating,
                    spacing: "2px",
                    starWidth: "15px",
                    fullStar: true,
                    readOnly: true
                }
            );
        });

        $(document).on('click', '.search', function (e) {
            e.preventDefault();
            var productId = $(this).attr('productId');
            $.ajax({
                type: 'get',
                url: "{{ route('get:quick_view_search') }}",
                data: {productId: productId},
                success: function (result) {
                    $.fancybox(result, {
                        // fancybox API options
                        fitToView: false,
                        autoSize: false,
                        closeClick: false,
                        openEffect: 'none',
                        closeEffect: 'none'
                    });
                }
            });
        });

        $(document).on('click', '.block-quickview .product-img-thumb a', function () {
            var image = $(this).data('image');
            $(this).closest('.product-image').find('.product-full img').attr('src', image);
            return false;
        });

        $(document).on('click', '.wishlist', function (e) {
            e.preventDefault();
            var wishlist = $(this);
            var productId = $(this).attr('productId');
            @if(Auth::check())
            $.ajax({
                type: 'get',
                url: "{{ route('get:add_to_wishlist') }}",
                data: {productId: productId},
                beforeSend: function () {
                    $(this).attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        wishlist.attr('disabled', false);
                        if (result.added == 1) {
                            wishlist.addClass('wishlisted');
                        } else {
                            wishlist.removeClass('wishlisted');
                        }
                        $.notify(result.message, "success");
                    }
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            });
            @else
            $('#loginRegister').trigger('click');
            $.notify("Please login for wishlisting a product", "error");
            @endif
        });

        $(document).on('change', '.brand', function (e) {
            e.preventDefault();
            var $this = $(this);
            $.ajax({
                type: 'get',
                url: "{{ route('get:brand_products_from_search') }}",
                data: $('#brandForm').serialize(),
                success: function (result) {
                    $('.product-list').html(result);
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            });
        });

        $(document).on('click', '.compare-product', function (e) {
            e.preventDefault();
            var productId = $(this).attr('productId');
            var compare = $(this);
            $.ajax({
                type: 'get',
                url: "{{ route('get:add_to_compare') }}",
                data: {productId: productId},
                beforeSend: function () {
                    $(this).attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        if (result.count != 0) {
                            showCompareBtn();
                        } else {
                            $('.compare-filed').html('');
                        }
                        $.notify(result.message, "success");
                        if (result.added == 1) {
                            compare.addClass('wishlisted');
                            compare.find('i').addClass('wishlisted-icon');
                        } else {
                            compare.removeClass('wishlisted');
                            compare.find('i').removeClass('wishlisted-icon');
                        }
                    }
                    if (result.error == true) {
                        $.notify(result.message, "error");
                        compare.removeClass('wishlisted');
                        compare.find('i').removeClass('wishlisted-icon');
                    }
                }
            });
        });

        function showCompareBtn() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:compare_btn') }}",
                success: function (result) {
                    $('.compare-filed').html(result);
                }
            });
        }

        $(window).scroll(function () {
            $('.compare-btn').addClass('fixed');
        });

        function getCart() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:cart') }}",
                beforeSend: function () {
                    $(this).html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                    $(this).attr('disabled', true);
                },
                success: function (result) {
                    $('#cart-block').html(result);
                }
            });
        }

        // CATEGORY FILTER
        $('.slider-range-price').each(function () {
            var min = $(this).data('min');
            var max = $(this).data('max');
            var unit = $(this).data('unit');
            var value_min = $(this).data('value-min');
            var value_max = $(this).data('value-max');
            var label_reasult = $(this).data('label-reasult');
            var t = $(this);
            $(this).slider({
                range: true,
                min: min,
                max: max,
                values: [value_min, value_max],
                slide: function (event, ui) {
                    var result = label_reasult + " " + unit + ui.values[0] + ' - ' + unit + ui.values[1];
                    t.closest('.slider-range').find('.amount-range-price').html(result);
                },
                stop: function (event, ui) {
                    getPriceProducts(ui)

                }
            });
        });

                {{--@if(isset($subId))--}}
        {{--var subId = '{{ $subId }}';--}}
        {{--@else--}}
        {{--var productId = '{{ $productId }}';--}}
        {{--@endif--}}
        function getPriceProducts(ui) {
            $.ajax({
                type: 'get',
                url: "{{ route('get:price_range_products_form_search') }}",
                data: {min: ui.values[0], max: ui.values[1]},
                success: function (result) {
                    $('.product-list').html(result);
                }
            });
        }
    </script>
@endsection