@extends('front.auth.layout.default')
@section('title')
    Product
@endsection
@section('page-css')
    <link rel="stylesheet" href="{{ asset('front/assets/css/product_details.css') }}">
    <style>
        .add-cart:before {
            width: 16px;
            height: 100%;
            float: left;
            background: url({{ asset('front/assets/images/cart.png') }}) no-repeat scroll left center;
            content: " ";
            margin-right: 15px;
        }
    </style>
@endsection
@section('body-class')
    class="product-page"
@endsection
@section('page-content')
    <div class="columns-container">
        <div class="container" id="columns">
            <!-- breadcrumb -->
            <div class="breadcrumb clearfix">
                <a class="home" href="#" title="Return to Home">Home</a>
                <span class="navigation-pipe">&nbsp;</span>
                <a href="#" title="Return to Home">{{ $product->CatName }}</a>
                <span class="navigation-pipe">&nbsp;</span>
                <a href="#" title="Return to Home">{{ $product->subCatName }}</a>
                <span class="navigation-pipe">&nbsp;</span>
                <span class="navigation_page">{{ $product->name }}</span>
            </div>
            <div class="row">
                <div class="column col-xs-12 col-sm-3" id="left_column">
                {{--@include('front.pages.include.categories')--}}

                @include('front.pages.include.best_seller_products')

                <!-- left silide -->
                    <div class="col-left-slide left-module">
                        <ul class="owl-carousel owl-style2" data-dots="true" data-loop="true" data-nav="false"
                            data-margin="0"
                            data-autoplayTimeout="1000" data-autoplayHoverPause="true" data-items="1"
                            data-autoplay="true">
                            @foreach($mainSliders as $mainSlider)
                                <li><a href="{{ $mainSlider->url }}">
                                        <img src="{{ asset('slider/'.$mainSlider->main_slider) }}"
                                             alt="slide-left"></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <!--./left silde-->
                    <!-- block best sellers -->
                @include('front.pages.include.on_sale_products')
                    <div class="col-left-slide left-module">
                        <div class="banner-opacity">
                            @if(count($sidebarSlider)>0)
                                <a href="{{ $sidebarSlider->url }}"><img src="{{ asset('slider/'.$sidebarSlider->sidebar_slider) }}"
                                                 alt="ads-banner"></a>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- ./left colunm -->
                <!-- Center colunm-->
                <div class="center_column col-xs-12 col-sm-9" id="center_column">
                    <!-- Product -->
                    <div id="product">
                        <div class="primary-box row">
                            <div class="pb-left-column col-xs-12 col-sm-6">
                                <!-- product-imge-->
                                <div class="product-image">
                                    <div class="product-full">
                                        <img id="product-zoom" src='{{ asset('420ProductImg/'.$product->product_img) }}'
                                             data-zoom-image="{{ asset('850ProductImg/'.$product->product_img) }}"/>
                                    </div>
                                    @if($product->video_thumb ||  $product->productScreenshots()->get())
                                        <div class="product-img-thumb" id="gallery_01">
                                            <ul class="owl-carousel" data-items="3" data-nav="true" data-dots="false"
                                                data-margin="20" data-loop="true">
                                                @if($product->video_thumb)
                                                    <div id="product-video" videoId="{{ $product->video_id }}">
                                                        <img src="{{ asset('videothumb/'.$product->video_thumb) }}"/>
                                                    </div>
                                                @endif
                                                @foreach($product->productScreenshots()->select('screenshots')->get() as $screenshot)
                                                    <li>
                                                        <a href="javascript:void(0);"
                                                           data-image="{{ asset('420ProductImg/'.$screenshot->screenshots) }}"
                                                           data-zoom-image="{{ asset('850ProductImg/'.$screenshot->screenshots) }}">
                                                            <img id="product-zoom"
                                                                 src="{{ asset('100ProductImg/'.$screenshot->screenshots) }}"/>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <!-- product-imge-->
                            </div>
                            <div class="pb-right-column col-xs-12 col-sm-6">
                                <h1 class="product-name">{{ ucwords($product->name) }}</h1>
                                <div class="product-comments">
                                    <div class="product-star">
                                        <div class="ratiyo-rating" data-rating="{{ $product->getAvgRating() }}"></div>
                                    </div>
                                    <div class="comments-advices">
                                        <a href="javascript:void(0);">Based on {{ $product->getAvgRating() }}
                                            ratings</a>
                                    </div>
                                </div>
                                <div class="product-price-group">
                                    @if(count($product->getDiscountPrice())>0)
                                        <span class="price fa fa-inr">{{ $product->getDiscountPrice() }}</span>
                                        <span class="old-price fa fa-inr">{{ $product->price }}</span>
                                    @else
                                        <span class="price"><i class="fa fa-inr"></i> {{ $product->price }}</span>
                                    @endif
                                    @if(count($product->getDiscountPercentage())>0)
                                        <span class="discount">{{ $product->getDiscountPercentage() }}%</span>
                                    @endif
                                </div>
                                <div class="info-orther">
                                    <p>Sold By : <span>@if($product->username == 'admin')
                                                LozyPay @else {{ $product->username }} @endif</span></p>
                                    <p>Availability: <span class="in-stock">@if($product->quantity != 0)
                                                In stock @else Not In Stock @endif</span></p>
                                    <p>Condition: New</p>
                                </div>
                                <div class="product-desc">
                                    {!! mb_strimwidth($product->desc, 0, 200, '...') !!}
                                </div>
                                <form id="productInfo">
                                    {{ csrf_field() }}
                                    @if(count($product->getDiscountPrice())>0)
                                        <input type="hidden" name="price" value="{{ $product->getDiscountPrice() }}">
                                    @else
                                        <input type="hidden" name="price" value="{{ $product->price }}">
                                    @endif
                                    <input type="hidden" name="slug" value="{{ $product->slug }}">
                                    <div class="form-option">
                                        <p class="form-option-title">Available Options:</p>
                                        @if(count($productColors)>0)
                                            <div class="attributes">
                                                <div class="attribute-label">Color:</div>
                                                <div class="color-choose">
                                                    @foreach($productColors as $productColor)
                                                        <div>
                                                            <input type="radio" class="select-color"
                                                                   id="{{ $productColor->desc }}" name="color"
                                                                   value="{{ $productColor->desc }}">
                                                            <label for="{{ $productColor->desc }}"><span
                                                                        style="background-color: {{ $productColor->desc }}"></span></label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        @if($product->quantity != 0)
                                            <div class="attributes">
                                                <div class="attribute-label">Qty:</div>
                                                <div class="attribute-list product-qty">
                                                    <div class="qty">
                                                        <input id="option-product-qty" type="text" min="1"
                                                               name="product_qty"
                                                               value="1">
                                                    </div>
                                                    <div class="btn-plus">
                                                        <a href="javascript:void(0);" class="btn-plus-up">
                                                            <i class="fa fa-caret-up"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="btn-plus-down">
                                                            <i class="fa fa-caret-down"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="attributes">
                                                <div class="attribute-label">Qty:</div>
                                                <p>Out of stock</p>
                                            </div>
                                        @endif
                                        @if(count($productSizes)>0)
                                            <div class="attributes">
                                                <div class="attribute-label">Size:</div>
                                                <div class="attribute-list">
                                                    <select name="size" class="producr-size">
                                                        @foreach($productSizes as $productSize)
                                                            <option value="{{ $productSize->desc }}">{{ ucwords($productSize->desc) }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($product->size_chart)
                                                        <a id="size_chart" class="fancybox"
                                                           href="{{ asset('sizechart/'.$product->size_chart) }}">Size
                                                            Chart</a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-action">
                                        <div class="button-group">
                                            <a class="btn-add-cart" slug="{{ $product->slug }}">Add to cart</a>
                                        </div>
                                    </div>
                                </form>
                                <div class="form-action" style="border-top: none;padding-bottom:0px;">
                                    <div class="button-group">
                                        <a class="wishlist @if($product->isWishListProducts()) wishlisted @endif"
                                           id="wishlist"
                                           productId="{{ $product->id }}"><i
                                                    class="fa fa-heart-o @if($product->isWishListProducts()) wishlisted-icon @endif"></i><br>Wishlist</a>
                                        <a class="compare compare-product @if($product->iscompareProducts()) wishlisted @endif"
                                           productId="{{ $product->id }}"><i
                                                    class="fa fa-signal @if($product->iscompareProducts()) wishlisted-icon @endif"></i>
                                            <br>
                                            Compare</a>
                                    </div>
                                </div>
                                <div class="form-share">
                                    <div class="sendtofriend-print">
                                        <a href="javascript:print();"><i class="fa fa-print"></i> Print</a>
                                        <a href="#"><i class="fa fa-envelope-o fa-fw"></i>Send to a friend</a>
                                    </div>
                                    <div class="network-share">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('front.pages.include.product_information')
                        @include('front.pages.include.related_products')
                        @include('front.pages.include.like_products')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="compare-filed">
        @if($product->checkCompareProducts() > 0)
            <a class="compare-btn"
               href="{{ route('get:compare') }}"><span class="G934d8"><span>COMPARE</span></span>
                <div class="_1j7Tzv">
                    <span class="compare-cont">{{ $product->CompareProducts() }}</span>
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


        $(document).on('click', '#product-video', function (e) {
            e.preventDefault();
            var modal = $('#defaultModal');
            setTimeout(function () {
                modal.modal('show');
            }, 230);
            var videId = $(this).attr('videoId');
            if (videId) {
                $('.modal-title').html('{{ $product->name }}');
                var url = '//www.youtube.com/embed/' + videId + '?rel=0';
                $('.modal-body').html('<iframe id="cartoonVideo" width="560" height="315" src="' + url + '" frameborder="0" allowfullscreen></iframe>');
            }
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

        $(document).on('click', '.btn-comment', function (e) {
            @if(Auth::check())
            e.preventDefault();
            var productId = $(this).attr('productId');
            $.ajax({
                type: 'get',
                url: "{{ route('get:add_review_form') }}",
                data: {productId: productId},
                beforeSend: function () {
                    $(this).attr('disabled', true);
                },
                success: function (result) {
                    $('.reviewForm').html(result);
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            });
            @else
            $('#loginRegister').trigger('click');
            @endif
        });

        $(document).on('submit', '#ratingForm', function (e) {
            e.preventDefault();
            var rating = $('.ratingValue').val();
            console.log(rating);
            if (rating == 0) {
                $.notify('Rating cannot be empty', "error");
                return false;
            }
            $.ajax({
                type: 'post',
                url: "{{ route('post:review') }}",
                data: $(this).serialize(),
                beforeSend: function () {
                    $("#btn-send-review").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                    $("#btn-send-review").attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        $('#ratingForm')[0].reset();
                        $("#btn-send-review").html('Submit');
                        $("#btn-send-review").attr('disabled', false);
                        location.reload();
                    }
                    if (result.success == false) {
                        $.notify(result.message, "error");
                        $("#btn-send-review").html('Submit');
                        $("#btn-send-review").attr('disabled', false);
                    }
                    if (result.error == true) {
                        $.each(result.message, function (index, error) {
                            var keys = Object.keys(result.message);
                            $('input[name="' + keys[0] + '"]').focus();
                            $('.' + index + '_error').html(error);
                        });
                        $(".btn-send-review").html('Submit');
                        $(".btn-send-review").attr('disabled', false);
                    }
                }
            });
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

        function showCompareBtn() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:compare_btn') }}",
                success: function (result) {
                    $('.compare-filed').html(result);
                }
            });
        }

        $(document).on('click', '.wishlist', function (e) {
            e.preventDefault();
            var wishlist = $(this);
            var productId = $(this).attr('productId');
            @if(Auth::check())
            $.ajax({
                type: 'get',
                url: "{{ route('get:add_to_wishlist') }}",
                data: {productId: '{{ $product->id }}'},
                beforeSend: function () {
                    $(this).attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        wishlist.attr('disabled', false);
                        if (result.added == 1) {
                            wishlist.addClass('wishlisted');
                            wishlist.find('i').addClass('wishlisted-icon');
                        } else {
                            wishlist.removeClass('wishlisted');
                            wishlist.find('i').removeClass('wishlisted-icon');
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

        $(document).ready(function () {
            $('.color-choose input').on('click', function () {
                $('.active').removeClass('active');
                $(this).addClass('active');
            });

        });

        $(document).on('click', '.btn-add-cart', function (e) {
            e.preventDefault();
            var $this = $(this);
            var color = null;
            var colorItem = $('.select-color');
            if (colorItem.length > 0) {
                if (!colorItem.hasClass('active')) {
                    $.notify("Select product color..!!", "error");
                    return false;
                }
            }
            $.ajax({
                type: 'get',
                url: "{{ route('get:add_to_cart') }}",
                data: $('#productInfo').serialize(),
                beforeSend: function () {
                    $this.html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                    $this.attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        $.notify(result.message, "success");
                        $this.html('Add to cart');
                        $this.attr('disabled', false);
                        getCart();
                    }
                    if (result.error == true) {
                        $.notify(result.message, "error");
                        $this.html('Add to cart');
                        $this.attr('disabled', false);
                    }
                }
            });
        });

        $(document).on('click', '.add-cart', function (e) {
            e.preventDefault();
            var $this = $(this);
            var slug = $this.attr('slug');
            $.ajax({
                type: 'get',
                url: "{{ route('get:add_to_cart') }}",
                data: {slug: slug},
                beforeSend: function () {
                    $this.html('<i style="margin-top: 10px;" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                    $this.attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        $this.html('Add to cart');
                        $this.attr('disabled', false);
                        getCart();
                        $.notify(result.message, "success");
                    }
                    if (result.error == true) {
                        $.notify(result.message, "error");
                        $this.html('Add to cart');
                        $this.attr('disabled', false);
                    }
                }
            });
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

        $(window).scroll(function () {
            $('.compare-btn').addClass('fixed');
        });
    </script>
@endsection