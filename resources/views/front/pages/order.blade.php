@extends('front.layout.default')

@section('title')
    Order
@endsection
@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/style.css') }}"/>
    <style>
        .page-order .cart_navigation .next-btn {
            float: right;
            background: #ff3366;
            color: #fff;
            border: 1px solid #ff3366;
        }

        .page-order .cart_navigation .next-btn {
            padding: 10px 20px;
            border: 1px solid #eaeaea;
        }

        .page-order .cart_avail .label-danger {
            background: #FFF;
            border: 1px solid #d9534f;
            color: #d9534f;
            font-weight: normal;
        }

        .page-order .cart_avail .label-warning {
            background: #FFF;
            border: 1px solid #f0ad4e;
            color: #f0ad4e;
            font-weight: normal;
        }

        .ecart {
            text-align: center;
            margin: 0 0 30px;
            overflow: hidden;
        }

        .ecart h1 {
            font-size: 18px !important;
            color: #000 !important;
            margin: 30px 0;
        }

        .continue-btn {
            padding: 10px 20px;
            border: 1px solid #eaeaea;
            display: block;
        }

        .continue-btn:hover {
            background: #ff3366;
            color: #fff;
        }
    </style>
@endsection
@section('body-class')
    class="category-page"
@endsection
@section('page-content')
<section id="product-details">
    <div class="columns-container">
        <div class="container" id="columns">
            <!-- breadcrumb -->
            <div class="row">
                <div class="col-12 p0">
                    <div class="page-location">
                        <ul>
                            <li>
                            <a href="#">Home / Your shopping cart</a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>    
            <!-- ./breadcrumb -->
            <!-- page heading-->
            <h2 class="page-heading no-line">
                @if(isset($recharge) && count($recharge)>0)
                    <span class="page-heading-title2">Recharge Summary</span>
                @else
                    <span class="page-heading-title2">Shopping Cart Summary</span>
                @endif
            </h2>
            <!-- ../page heading-->
            <div class="page-content page-order">
                @if(isset($products) && count($products) == 0)
                    <div class="heading-counter warning">Shopping cart Empty:
                        <span>0 Product</span>
                    </div>
                @endif
                <div class="order-detail-content">
                    @if(isset($recharge) && count($recharge)>0)
                        @include('front.pages.recharge.recharge_checkout')
                    @else
                        @include('front.pages.include.product_checkout')
                    @endif
                    <div class="cart_navigation">
                        @if(isset($products) && count($products) > 0)
                            <a class="prev-btn" href="{{ route('get:homepage') }}">Continue shopping</a>
                        @endif
                        @if(isset($recharge))
                            @if($recharge->status != 'Success')
                                <a href="{{ route('get:process_transaction', $recharge->transaction_id) }}"
                                   class="next-btn proceedToRecharge">Proceed
                                    to Recharge
                                </a>
                            @else
                                <a href="{{ route('get:homepage') }}" class="next-btn">Recharge Again</a>
                            @endif
                        @elseif(isset($products) && count($products) != 0)
                            <a href="javascript:void(0);" id="proccetCheckout" class="next-btn">Proceed to
                                checkout</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>    
@endsection
@section('page-js')
    <script>
        @if(isset($recharge))
        $(window).on('load', function () {
            var status = '{{ $recharge->status }}';
            showAndroidToast(status);
        });

        function showAndroidToast(status) {
            Android.showAndroid(status);
        }

        @endif

        $(document).on('click', '.proceedToRecharge', function () {
            @if(!Auth::check())
            $('#loginRegister').trigger('click');
            $.notify("Please login for recharge", "error");
            return false;
            @endif
        });

        $(document).on('click', '#proccetCheckout', function (e) {
            e.preventDefault();
            var url = '{{ route('get:checkout') }}';
            @if(!Auth::check())
            $.cookie("url", url);
            $('#loginRegister').trigger('click');
            $.notify("Please login for checkout", "error");
            return false;
            @else
                window.location.href = "{{ route('get:checkout') }}";
            @endif
        });

        $(document).on('submit', '#rechargeCheckout', function (e) {
            e.preventDefault();
            @if(Auth::check())
            $.ajax({
                type: 'post',
                url: "{{ route('post:checkout') }}",
                data: $(this).serialize(),
                beforeSend: function () {
                    $(".proceedToRecharge").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                    $(".proceedToRecharge").attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        $(".proceedToRecharge").html('Process to Recharge');
                        $(".proceedToRecharge").attr('disabled', false);
                        window.location.href = result.url
                    } else {
                        $.notify(result.message, "error");
                    }
                }
            });
            @else
            $('#loginRegister').trigger('click');
            $.notify("Please login for recharge", "error");
            @endif
        });
    </script>
@endsection