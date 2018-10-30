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

        .paragraph-end {
            background-image: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(255, 255, 255, 0)), color-stop(100%, rgba(255, 255, 255, 1)));
            background-image: -webkit-linear-gradient(left, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
            background: linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
            filter: progid:DXImageTransform.Microsoft.gradient(GradientType=1, StartColorStr='#00ffffff', EndColorStr='#ffffff');
            bottom: 37px;
            height: 23px;
            max-height: 100%;
            position: absolute;
            right: 17px;
            width: 60px;
        }

        .compare-filed {
            position: fixed;
            bottom: 20px;
            left: 15px;
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

        .fixed {
            position: fixed;
        }

        .sortPagiBar .sort-product, .sortPagiBar .show-product-item {
            float: left;
        }
    </style>
@endsection
@section('title')
    Category
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
                <span class="navigation_page">{{ $subcategory->name }}</span>
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
                    <div class="block left-module">
                        <p class="title_block">Filter selection</p>
                        <div class="block_content">
                            <!-- layered -->
                            <div class="layered layered-filter-price">
                            {{--<!-- filter categgory -->--}}
                            {{--<div class="layered_subtitle">CATEGORIES</div>--}}
                            {{--<div class="layered-content">--}}
                            {{--<ul class="check-box-list">--}}
                            {{--<li>--}}
                            {{--<input type="checkbox" id="c1" name="cc"/>--}}
                            {{--<label for="c1">--}}
                            {{--<span class="button"></span>--}}
                            {{--Tops<span class="count">(10)</span>--}}
                            {{--</label>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<input type="checkbox" id="c2" name="cc"/>--}}
                            {{--<label for="c2">--}}
                            {{--<span class="button"></span>--}}
                            {{--T-shirts<span class="count">(10)</span>--}}
                            {{--</label>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<input type="checkbox" id="c3" name="cc"/>--}}
                            {{--<label for="c3">--}}
                            {{--<span class="button"></span>--}}
                            {{--Dresses<span class="count">(10)</span>--}}
                            {{--</label>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<input type="checkbox" id="c4" name="cc"/>--}}
                            {{--<label for="c4">--}}
                            {{--<span class="button"></span>--}}
                            {{--Jackets and coats<span class="count">(10)</span>--}}
                            {{--</label>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<input type="checkbox" id="c5" name="cc"/>--}}
                            {{--<label for="c5">--}}
                            {{--<span class="button"></span>--}}
                            {{--Knitted<span class="count">(10)</span>--}}
                            {{--</label>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<input type="checkbox" id="c6" name="cc"/>--}}
                            {{--<label for="c6">--}}
                            {{--<span class="button"></span>--}}
                            {{--Pants<span class="count">(10)</span>--}}
                            {{--</label>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<input type="checkbox" id="c7" name="cc"/>--}}
                            {{--<label for="c7">--}}
                            {{--<span class="button"></span>--}}
                            {{--Bags & Shoes<span class="count">(10)</span>--}}
                            {{--</label>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<input type="checkbox" id="c8" name="cc"/>--}}
                            {{--<label for="c8">--}}
                            {{--<span class="button"></span>--}}
                            {{--Best selling<span class="count">(10)</span>--}}
                            {{--</label>--}}
                            {{--</li>--}}
                            {{--</ul>--}}
                            {{--</div>--}}
                            <!-- ./filter categgory -->
                                <!-- filter price -->
                                <div class="layered_subtitle">price</div>
                                <div class="layered-content slider-range">
                                    <div data-label-reasult="Range:" data-min="0" data-max="{{ $max }}"
                                         data-unit="$"
                                         class="slider-range-price" data-value-min="0"
                                         data-value-max="{{ $max }}"></div>
                                    <div class="amount-range-price">Range: <i class="fa fa-inr"></i> 0 - <i
                                                class="fa fa-inr"></i> {{ $max }}</div>
                                </div>
                                <!-- ./filter price -->
                                <!-- filter color -->
                                @if(count($productColors)>0)
                                    <div class="layered_subtitle">Color</div>
                                    <div class="layered-content filter-color">
                                        <ul class="check-box-list">
                                            <form class="attrtibuteForm">
                                                <input type="hidden" name="slug" value="{{ $subcategory->slug }}">
                                                @foreach($productColors as $productColor)
                                                    <li>
                                                        <input type="checkbox" class="attribute"
                                                               id="color{{ $productColor['id'] }}"
                                                               value="{{ $productColor['id'] }}" name="attribute[]"/>
                                                        <label style=" background:{{ $productColor['color'] }};"
                                                               for="color{{ $productColor['id'] }}"><span
                                                                    class="button"></span></label>
                                                    </li>
                                                @endforeach
                                            </form>
                                        </ul>
                                    </div>
                                @endif
                            <!-- ./filter color -->
                                <!-- ./filter brand -->
                                @if(count($productBrands)>0)
                                    <div class="layered_subtitle">brand</div>
                                    <div class="layered-content filter-brand">
                                        <ul class="check-box-list">
                                            <form id="brandForm">
                                                <input type="hidden" name="slug" value="{{ $subcategory->slug }}">
                                                @foreach($productBrands as $key => $productBrand)
                                                    <li>
                                                        <input type="checkbox" class="brand" id="brand{{$key}}"
                                                               value="{{ $productBrand->brandId }}" name="brandId[]"/>
                                                        <label for="brand{{ $key }}" class="select-brand">
                                                            <span class="button"></span>
                                                            {{ trim($productBrand->getBrandName()) }}
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </form>
                                        </ul>
                                    </div>
                                @endif
                            <!-- ./filter brand -->
                                <!-- ./filter size -->
                                @if(count($productSizes)>0)
                                    <div class="layered_subtitle">Size</div>
                                    <div class="layered-content filter-size">
                                        <ul class="check-box-list">
                                            <form class="attrtibuteForm">
                                                <input type="hidden" name="slug" value="{{ $subcategory->slug }}">
                                                @foreach($productSizes as $productSize)
                                                    <li>
                                                        <input type="checkbox" class="attribute"
                                                               id="size{{$productSize['id']}}"
                                                               value="{{$productSize['id']}}" name="attribute[]"/>
                                                        <label for="size{{$productSize['id']}}" class="select-size">
                                                            <span class="button"></span>{{ $productSize['size'] }}
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </form>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- ./block filter  -->
                    <!-- left silide -->
                    <div class="col-left-slide left-module">
                        <ul class="owl-carousel owl-style2" data-loop="true" data-nav="false" data-margin="30"
                            data-autoplayTimeout="1000" data-autoplayHoverPause="true" data-items="1"
                            data-autoplay="true">
                            @foreach($sidebarSliders as $sidebarSlider)
                                <li>
                                    <a href="#">
                                        <img src="{{ asset('slider/'.$sidebarSlider->sidebar_slider) }}"
                                             alt="{{ $sidebarSlider->sidebar_slider }}">
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <!--./left silde-->
                    <!-- SPECIAL -->
                    @if(count($specialProduct)>0)
                        <div class="block left-module">
                            <p class="title_block">SPECIAL PRODUCTS</p>
                            <div class="block_content">
                                <ul class="products-block">
                                    <li>
                                        <div class="products-block-left">
                                            <a href="{{ route('get:product_detail', $specialProduct->slug) }}">
                                                <img src="{{ asset('100ProductImg/'.$specialProduct->product_img) }}"
                                                     alt="{{ $specialProduct->product_img }}">
                                            </a>
                                        </div>
                                        <div class="products-block-right">
                                            <a href="{{ route('get:product_detail', $specialProduct->slug) }}"
                                               title="{{ $specialProduct->name }}">{{ ucwords($specialProduct->name) }}</a>
                                            <div class="paragraph-end"></div>
                                            @if(count($specialProduct->getDiscountPrice())>0)
                                                <p class="product-price"> {{ $specialProduct->getDiscountPrice() }}</p>
                                            @else
                                                <p class="product-price"><i
                                                            class="fa fa-inr"></i> {{ $specialProduct->price }}</p>
                                            @endif

                                            <p class="product-star">
                                            <div class="ratiyo-rating"
                                                 data-rating="{{ $specialProduct->getAvgRating() }}"></div>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                <!-- ./SPECIAL -->
                    {{--@include('front.pages.include.tags')--}}
                    @include('front.pages.include.testimonials')
                </div>
                <!-- ./left colunm -->
                <!-- Center colunm-->
                <div class="center_column col-xs-12 col-sm-9" id="center_column">
                    <!-- category-slider -->
                    <div class="category-slider">
                        <ul class="owl-carousel owl-style2" data-dots="false" data-loop="true" data-nav="true"
                            data-autoplayTimeout="1000" data-autoplayHoverPause="true" data-items="1">
                            @foreach($mainSliders as $mainSlider)
                                <li>
                                    <img src="{{ asset('slider/'.$mainSlider->main_slider) }}"
                                         alt="{{ $mainSlider->main_slider }}">
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- ./category-slider -->
                    <!-- subcategories -->
                    <div class="subcategories">
                        <ul>
                            <li class="current-categorie">
                                <a href="#">{{ $subcategory->category()->first()->name}}</a>
                            </li>
                            @foreach($category->subCategories()->take(5)->get() as $subcategory)
                                <li>
                                    <a href="{{ route('get:sub_category_products', ['cat' => $category->slug, 'subCatSlug' => $subcategory->slug]) }}">{{ $subcategory->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- ./subcategories -->
                    <!-- view-product-list-->
                    <div id="view-product-list" class="view-product-list">
                        <h2 class="page-heading">
                            <span class="page-heading-title">{{ $subcategory->name }}</span>
                        </h2>
                        <ul class="display-product-option">
                            <li class="view-as-grid selected">
                                <span>grid</span>
                            </li>
                            <li class="view-as-list">
                                <span>list</span>
                            </li>
                        </ul>
                        <ul class="row" style="margin-bottom: 10px;">
                            <div class="sortPagiBar">
                                <div class="sort-product">
                                    <select>
                                        <option value="">New</option>
                                        <option value="">Popular</option>
                                        <option value="">Price low to high</option>
                                        <option value="">Price high to low</option>
                                    </select>
                                    <div class="sort-product-icon">
                                        <i class="fa fa-sort-alpha-asc"></i>
                                    </div>
                                </div>
                            </div>
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
                                                <a title="Add to Cart" class="btn-add-cart"
                                                   href="{{ route('get:product_detail', $product->slug) }}">Add to
                                                    Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a
                                                        href="{{ route('get:product_detail', $product->slug) }}">{{ mb_strimwidth($product->name, 0, 50, '...') }}</a>
                                                <div class="paragraph-end"></div>
                                            </h5>
                                            <div class="product-star">
                                                <div class="ratiyo-rating"
                                                     data-rating="{{ $product->getAvgRating() }}"></div>
                                            </div>
                                            <div class="content_price">
                                                @if(count($product->getDiscountPrice())>0)
                                                    <span class="price"><i
                                                                class="fa fa-inr"></i>{{ $product->getDiscountPrice() }}</span>
                                                    <span class="old-price"><i
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
            console.log($('#brandForm').serialize());
            var $this = $(this);
            $.ajax({
                type: 'get',
                url: "{{ route('get:brand_products') }}",
                data: $('#brandForm').serialize(),
                success: function (result) {
                    $('.product-list').html(result);
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            });
        });

        $(document).on('change', '.attribute', function (e) {
            e.preventDefault();
            var $this = $(this);
            $.ajax({
                type: 'get',
                url: "{{ route('get:attribute_products') }}",
                data: $('.attrtibuteForm').serialize(),
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
            var slug = '{{ $subcategory->slug }}';
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
                    var slug = '{{ $subcategory->slug }}';
                    $.ajax({
                        type: 'get',
                        url: "{{ route('get:price_range_products') }}",
                        data: {min: ui.values[0], max: ui.values[1], slug: slug},
                        success: function (result) {
                            $('.product-list').html(result);
                        }
                    });
                }
            });
        })
    </script>
@endsection