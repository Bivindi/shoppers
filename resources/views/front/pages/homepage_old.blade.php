@extends('front.layout.default')
@section('title')
    Homepage
@endsection
@section('page-css')
    <style>
        .efb {
            cursor: pointer;
        }

        .recharge {
            padding: 0px;
        }

        .changesec span {
            font-size: 11px;
            padding-bottom: 4px;
        }

        .recharge-plans {
            list-style: none;
            font-size: 12px;
            max-height: 424px;
            overflow-y: auto;
        }

        .plans {
            padding: 14px 30px;
            border-bottom: 1px solid #f7f9fa;
            cursor: pointer;
        }

        .recharge-plans li:hover {
            background: #f7f9fa;
        }

        .recharge-order .dataprof {
            margin-top: 30px;
        }

        .plan-price {
            display: inline-block;
            vertical-align: middle;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 1px solid #e4e4e4;
            font-size: 16px;
            font-weight: 300;
            color: #7a7a79;
            text-align: center;
            line-height: 2.9;
        }

        .plan-details {
            display: inline-block;
            vertical-align: middle;
            margin-left: 28px;
            line-height: 1.5;
            max-width: 425px;
        }

        .block-quickview {
            padding: 15px;
            background: #fff;
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

        .fixed {
            position: fixed;
        }

        @media (max-width: 1366px) and (min-width: 1200px) {
            .plan-details {
                max-width: 300px;
            }
        }

        .paragraph-end {
            background-image: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(255, 255, 255, 0)), color-stop(100%, rgba(255, 255, 255, 1)));
            background-image: -webkit-linear-gradient(left, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
            background: linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
            filter: progid:DXImageTransform.Microsoft.gradient(GradientType=1, StartColorStr='#00ffffff', EndColorStr='#ffffff');
            bottom: 28px;
            height: 23px;
            max-height: 100%;
            position: absolute;
            right: 0px;
            width: 60px;
        }

        .details {
            color: #a4a9ac;
        }

        .validity {
            color: #7a7a79;
            font-weight: 700;
        }

        .abc input, .abc select {
            border: none;
            border-bottom: 1px solid #ebebeb !important;
            border-radius: 0px;
            box-shadow: none !important;
        }

        @if($footerImage)
        #footer2 .footer-paralax {
            background: url('{{ asset('slider/'.$footerImage->footer_slider ) }}') 50% 0 no-repeat fixed;
        }
        @endif
    </style>
@endsection
@section('body-class')
    class="home option4"
@endsection

@section('recharge-panel')
    
@endsection
@section('page-content')
    @include('front.pages.include.slider')
    <!-- END Home slideder-->
    <!-- top banner -->
    <style>
        @media only screen and (max-width: 480px) {
   #bottom_slider_banner_1, #bottom_slider_banner_3 {display:none;}
}
    </style>
    <div class="group-banner4">
        <div class="container">
            <ul class="list-banner">
                @if(isset($smallSlider1->small_slider) && File::exists(public_path('slider/'.$smallSlider1->small_slider)))
                    <li>
                        <div class="banner-opacity" id="bottom_slider_banner_1">
                            <a href="{{ $smallSlider1->url }}">
                                <img src="{{ asset('slider/'.$smallSlider1->small_slider) }}"
                                     alt="{{ $smallSlider1->small_slider }}"></a>
                        </div>
                    </li>
                @endif
                @if(isset($mediumSlider1->medium_slider) && File::exists(public_path('slider/'.$mediumSlider1->medium_slider)))
                    <li>
                        <div class="banner-opacity" id="bottom_slider_banner_2">
                            <a href="{{ $mediumSlider1->url }}"><img src="{{ asset('slider/'.$mediumSlider1->medium_slider) }}"
                                             alt="{{ $mediumSlider1->medium_slider }}"></a>
                        </div>
                    </li>
                @endif
                @if(isset($smallSlider2->small_slider) && File::exists(public_path('slider/'.$smallSlider2->small_slider)))
                    <li>
                        <div class="banner-opacity" id="bottom_slider_banner_3">
                            <a href="{{ $smallSlider2->url }}">
                                <img src="{{ asset('slider/'.$smallSlider2->small_slider) }}"
                                     alt="{{ $smallSlider2->small_slider }}"></a>
                        </div>
                    </li>
                @endif
                @if(isset($mediumSlider2->medium_slider) && File::exists(public_path('slider/'.$mediumSlider2->medium_slider)))
                    <li>
                        <div class="banner-opacity" id="bottom_slider_banner_4">
                            <a href="{{ $mediumSlider2->url }}"><img src="{{ asset('slider/'.$mediumSlider2->medium_slider) }}"
                                             alt="{{ $mediumSlider2->medium_slider }}"></a>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <!-- ./top banner -->
    <!-- Hot deals -->
    <div class="hot-deals-row">
        <div class="container">
            <div class="hot-deals-box">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="hot-deals-tab">
                            <div class="hot-deals-title vertical-text">
                                <span>h</span>
                                <span>o</span>
                                <span>t</span>
                                <span class="yellow">d</span>
                                <span class="yellow">e</span>
                                <span class="yellow">a</span>
                                <span class="yellow">l</span>
                                <span class="yellow">s</span>
                            </div>
                            <div class="hot-deals-tab-box">
                                <ul class="nav-tab">
                                    <li class="active"><a data-toggle="tab" href="#hot-deal-1">UP TO 40% OFF</a></li>
                                    <li><a data-toggle="tab" href="#hot-deal-2">UP TO 50% OFF</a></li>
                                    <li><a data-toggle="tab" href="#hot-deal-3">UP TO 60% OFF</a></li>
                                    <li><a data-toggle="tab" href="#hot-deal-4">UP TO 70% OFF</a></li>
                                    <li><a data-toggle="tab" href="#hot-deal-5">UP TO 80% OFF</a></li>
                                </ul>
                                <di class="box-count-down">
                                    <span class="countdown-lastest" data-y="2018" data-m="3" data-d="1" data-h="5"
                                          data-i="55" data-s="00"></span>
                                </di>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-8 hot-deals-tab-content-col">
                        <div class="hot-deals-tab-content tab-container">
                            <div id="hot-deal-1" class="tab-panel active">
                                <ul class="product-list owl-carousel nav-center" data-dots="false" data-loop="true"
                                    data-nav="true" data-margin="10"
                                    data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    @foreach($upTo40Discounts as $product)
                                        @include('front.pages.product.homepage_offer_products')
                                    @endforeach
                                </ul>
                            </div>
                            <div id="hot-deal-2" class="tab-panel">
                                <ul class="product-list owl-carousel nav-center" data-dots="false" data-loop="true"
                                    data-nav="true" data-margin="29" data-autoplayTimeout="1000"
                                    data-autoplayHoverPause="true"
                                    data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    @foreach($upTo50Discounts as $product)
                                        @include('front.pages.product.homepage_offer_products')
                                    @endforeach
                                </ul>
                            </div>
                            <div id="hot-deal-3" class="tab-panel">
                                <ul class="product-list owl-carousel nav-center" data-dots="false" data-loop="true"
                                    data-nav="true" data-margin="29" data-autoplayTimeout="1000"
                                    data-autoplayHoverPause="true"
                                    data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    @foreach($upTo60Discounts as $product)
                                        @include('front.pages.product.homepage_offer_products')
                                    @endforeach
                                </ul>
                            </div>
                            <div id="hot-deal-4" class="tab-panel">
                                <ul class="product-list owl-carousel nav-center" data-dots="false" data-loop="true"
                                    data-nav="true" data-margin="29" data-autoplayTimeout="1000"
                                    data-autoplayHoverPause="true"
                                    data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    @foreach($upTo70Discounts as $product)
                                        @include('front.pages.product.homepage_offer_products')
                                    @endforeach
                                </ul>
                            </div>
                            <div id="hot-deal-5" class="tab-panel">
                                <ul class="product-list owl-carousel nav-center" data-dots="false" data-loop="true"
                                    data-nav="true" data-margin="29" data-autoplayTimeout="1000"
                                    data-autoplayHoverPause="true"
                                    data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    @foreach($upTo80Discounts as $product)
                                        @include('front.pages.product.homepage_offer_products')
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./Hot deals -->
    <!-- box product new arrivals -->
    @include('front.pages.include.new_arrivals_products')
    <!-- ./box product new arrivals -->
    <!-- box product TOP SELLERS IN -->
    @include('front.pages.include.top_seller_products')
    <!-- ./box product TOP SELLERS IN -->
    <!-- Banner -->
    @include('front.pages.include.banner')
    <!-- ./Banner -->
    <!-- box product special-products -->
    @include('front.pages.include.special_products')
    <!-- ./box product SPECIAL PRODUCTS -->
    <!-- box product RECOMMENDATION FOR YOU -->
    @include('front.pages.include.recommendation_products')
    <!-- ./box product RECOMMENDATION FOR YOU -->
    {{--@include('front.pages.include.blog')--}}

    <div class="modal fade" id="rechargeModal">
        <div class="modal-dialog modal-lg animated">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">

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
        $(document).on('click', '#prepaid', function (e) {
            e.preventDefault();
            var modal = $('#rechargeModal');
            setTimeout(function () {
                modal.modal('show');
            }, 230);
            $.ajax({
                type: 'get',
                url: "{{ route('get:prepaid_recharge') }}",
                beforeSend: function () {
                    $('#rechargeModal').find('.modal-body').html('<div class="text-center" style="min-height: 300px;"><i class="fa fa-spinner fa-spin fa-3x text-center fa-fw" style="position: absolute;top: 40%;"></i></div>');
                },
                success: function (result) {
                    $('.modal-title').html('Prepaid Recharge');
                    $('.modal-body').html(result);
                }
            });
        });

        $(document).on('click', '#postpaid', function (e) {
            e.preventDefault();
            var modal = $('#rechargeModal');
            setTimeout(function () {
                modal.modal('show');
            }, 230);
            $.ajax({
                type: 'get',
                url: "{{ route('get:postpaid_recharge') }}",
                success: function (result) {
                    $('.modal-title').html('Postpaid Recharge');
                    $('.modal-body').html(result);
                }
            });
        });

        $(document).on('click', '#dataCard', function (e) {
            e.preventDefault();
            var modal = $('#rechargeModal');
            setTimeout(function () {
                modal.modal('show');
            }, 230);
            $.ajax({
                type: 'get',
                url: "{{ route('get:datacard_recharge') }}",
                success: function (result) {
                    $('.modal-title').html('DataCard Recharge');
                    $('.modal-body').html(result);
                }
            });
        });

        $(document).on('click', '#dth', function (e) {
            e.preventDefault();
            var modal = $('#rechargeModal');
            setTimeout(function () {
                modal.modal('show');
            }, 230);
            $.ajax({
                type: 'get',
                url: "{{ route('get:dth_recharge') }}",
                success: function (result) {
                    $('.modal-title').html('DTH Recharge');
                    $('.modal-body').html(result);
                }
            });
        });

        $(document).on('click', '#broadband', function (e) {
            e.preventDefault();
            var modal = $('#rechargeModal');
            setTimeout(function () {
                modal.modal('show');
            }, 230);
            $.ajax({
                type: 'get',
                url: "{{ route('get:broadband_recharge') }}",
                success: function (result) {
                    $('.modal-title').html('Broadband Recharge');
                    $('.modal-body').html(result);
                }
            });
        });

        $(document).on('click', '#electricity', function (e) {
            e.preventDefault();
            var modal = $('#rechargeModal');
            setTimeout(function () {
                modal.modal('show');
            }, 230);
            $.ajax({
                type: 'get',
                url: "{{ route('get:electricity_recharge') }}",
                success: function (result) {
                    $('.modal-title').html('Electricity Recharge');
                    $('.modal-body').html(result);
                }
            });
        });
        $(document).on('click', '#gas', function (e) {
            e.preventDefault();
            var modal = $('#rechargeModal');
            setTimeout(function () {
                modal.modal('show');
            }, 230);
            $.ajax({
                type: 'get',
                url: "{{ route('get:gas_recharge') }}",
                success: function (result) {
                    $('.modal-title').html('Gas Recharge');
                    $('.modal-body').html(result);
                }
            });
        });

        $(document).on('click', '#water', function (e) {
            e.preventDefault();
            var modal = $('#rechargeModal');
            setTimeout(function () {
                modal.modal('show');
            }, 230);
            $.ajax({
                type: 'get',
                url: "{{ route('get:water_recharge') }}",
                success: function (result) {
                    $('.modal-title').html('Water Recharge');
                    $('.modal-body').html(result);
                }
            });
        });

        $(document).on('click', '#landline', function (e) {
            e.preventDefault();
            var modal = $('#rechargeModal');
            setTimeout(function () {
                modal.modal('show');
            }, 230);
            $.ajax({
                type: 'get',
                url: "{{ route('get:land_line_recharge') }}",
                success: function (result) {
                    $('.modal-title').html('Landline Recharge');
                    $('.modal-body').html(result);
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

        $(document).on('click', '.block-quickview .product-img-thumb a', function () {
            var image = $(this).data('image');
            $(this).closest('.product-image').find('.product-full img').attr('src', image);
            return false;
        });

        $(document).on('click', '.category-product', function (e) {
            e.preventDefault();
            var $this = $(this);
            var catId = $this.attr('catId');
            var type = $this.attr('type');
            $.ajax({
                type: 'get',
                url: "{{ route('get:category_products') }}",
                data: {catId: catId, type: type},
                success: function (result) {
                    $this.parent().parent().find('li').removeClass('active');
                    $this.parent().addClass('active');
                    $('.newCatProduct').addClass('active');
                    $('.newCatProduct').html(result);
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            });
        });

        $(document).on('click', '.special-product', function (e) {
            e.preventDefault();
            var $this = $(this);
            var catId = $this.attr('catId');
            var type = $this.attr('type');
            $.ajax({
                type: 'get',
                url: "{{ route('get:category_products') }}",
                data: {catId: catId, type: type},
                success: function (result) {
                    $this.parent().parent().find('li').removeClass('active');
                    $this.parent().addClass('active');
                    $('.specialProduct').addClass('active');
                    $('.specialProduct').html(result);
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            });
        });

        $(document).on('click', '.recommend-product', function (e) {
            e.preventDefault();
            var $this = $(this);
            var catId = $this.attr('catId');
            var type = $this.attr('type');
            $.ajax({
                type: 'get',
                url: "{{ route('get:category_products') }}",
                data: {catId: catId, type: type},
                success: function (result) {
                    $this.parent().parent().find('li').removeClass('active');
                    $this.parent().addClass('active');
                    $('.recommendProducts').addClass('active');
                    $('.recommendProducts').html(result);
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            });
        });

        $(document).on('click', '.top-seller-product', function (e) {
            e.preventDefault();
            var $this = $(this);
            var catId = $this.attr('catId');
            $.ajax({
                type: 'get',
                url: "{{ route('get:top_seller_products') }}",
                data: {catId: catId},
                success: function (result) {
                    $('.seller-nav').find('li').removeClass('active');
                    $this.parent().addClass('active');
                    $('.sellerProductTab').addClass('active');
                    $('.sellerProductTab').html(result);
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            });
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

        function shakeRechargeModal() {
            $('#defaultModal .modal-dialog').addClass('shake');
            setTimeout(function () {
                $('#defaultModal .modal-dialog').removeClass('shake');
            }, 1000);
        }
    </script>
@endsection