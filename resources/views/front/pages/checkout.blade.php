@extends('front.layout.default')

@section('title')
    Checkout
@endsection
@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/style.css') }}"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
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

        .address-bar .address {
            width: 257px;
            border: 1px solid #DEEAEE;
            border-radius: 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            padding: 10px;
            margin: 10px 10px 10px 0;
            float: left !important;
            min-height: 150px;
            height: 100%;
            display: block;
        }

        .address-bar .icon-Delete:hover {
            background: #00ff00;
            color: #fff;
        }

        .address-bar:hover .icon-Delete {
            display: block;
        }

        .icon-Delete {
            display: none;
        }

        .address-bar .icon-Delete {
            position: absolute;
            margin: 11px 0 0 237px;
            background: #fff;
            color: #00ff00;
            font-size: 10px;
            font-weight: 600;
            border: 1px solid #00ff00;
            padding: 5px;
        }

        .selected {
            border-color: #00ff00 !important;
        }

        .addressBtn {
            cursor: pointer;
        }

        .add-address {
            cursor: pointer;
        }

        .add-address .address:hover {
            border: 1px dashed #00B9F5;
            color: #00B9F5;
        }

        .add-address .text {
            border-radius: 40px;
            -moz-border-radius: 40px;
            -webkit-border-radius: 40px;
            border: 1px solid #DEEAEE;
            padding: 3px 6px;
            color: #828282;
            font-size: 25px;
            margin: 27px auto 0;
            width: 42px;
            text-align: center;
            cursor: pointer;
        }

        .center {
            width: 100%;
            margin: 0 auto;
        }

        .login-register {
            color: red;
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
    <div class="columns-container">
        <div class="container" id="columns">
            <!-- breadcrumb -->
            <div class="breadcrumb clearfix">
                <a class="home" href="#" title="Return to Home">Home</a>
                <span class="navigation-pipe">&nbsp;</span>
                <span class="navigation_page">Checkout</span>
            </div>
            <!-- ./breadcrumb -->
            <!-- page heading-->
            <h2 class="page-heading">
                <span class="page-heading-title2">Checkout</span>
            </h2>
            <!-- ../page heading-->
            <div class="page-content checkout-page">
                @if(\Illuminate\Support\Facades\Auth::check())
                    <h3 class="checkout-sep">3. Shipping Address</h3>
                    <form action="{{ route('post:product_order') }}" method="post" id="OrderPlaceForm">
                        {{ csrf_field() }}
                        <div class="box-border">
                            <div class="row">
                                @foreach($shippingAddress as $address)
                                    <div class="col-sm-3">
                                        <div class="address-bar">
                                            <i class="fa fa-trash icon-Delete" shippingId="{{ $address->id }}"
                                               role="button" tabindex="0" aria-hidden="true"></i>
                                            <div class="address addressBtn @if($address->status == 1) selected @endif"
                                                 shippingId="{{ $address->id }}">
                                                <h4>{{ $address->first_name. ''. $address->last_name }}</h4>
                                                <p>{{ $address->address }}<br>{{ $address->city }} {{ $address->state }}
                                                    <br>{{ $address->pin_code }}
                                                    <br><span>{{ $address->mobile_num }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-sm-3 add-address">
                                    <div class="address-bar">
                                        <div class="address text-center">
                                            <div class="text">+</div>
                                            Add New Address
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="shipping-address">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-border">
                            <div class="col-sm-6">
                                <h3 class="checkout-sep">4. Shipping Method</h3>
                                <ul class="shipping_method">
                                    <li>
                                        <label for="radio_button_3"><input type="radio" class="shipping-type" price="0"
                                                                           checked name="shipping_type"
                                                                           value="{{ \App\Model\ShippingAddress::FREE }}"
                                                                           id="radio_button_3">Free
                                            <i class="fa fa-inr"></i>0</label>
                                    </li>

                                    {{--<li>--}}
                                        {{--<label for="radio_button_4">--}}
                                            {{--<input type="radio" class="shipping-type" price="5" name="shipping_type" value="{{ \App\Model\ShippingAddress::STANDARD }}" id="radio_button_4">--}}
                                            {{--Standard--}}
                                            {{--Shipping <i class="fa fa-inr"></i> 5.00</label>--}}
                                    {{--</li>--}}
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <h3 class="checkout-sep">5. Payment Information</h3>
                                <ul>
                                    {{--<li>--}}
                                        {{--<label for="radio_button_5"><input type="radio" checked name="payment_type"--}}
                                                                           {{--value="{{ \App\Model\Order::CHECKORMONEY }}"--}}
                                                                           {{--id="radio_button_5">--}}
                                            {{--Net banking</label>--}}
                                    {{--</li>--}}

                                    <li>
                                        <label for="radio_button_6"><input type="radio" name="payment_type"
                                                                           value="{{ \App\Model\Order::DEBITCARD }}"
                                                                           id="radio_button_6">
                                            Debit card(saved)</label>
                                    </li>
                                    <li>
                                        <label for="radio_button_7"><input type="radio" name="payment_type"
                                                                           value="{{ \App\Model\Order::CASHONDELIVERY }}"
                                                                           id="radio_button_7" checked>
                                            COD</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="checkout-sep">6. Order Review</h3>
                        <div class="box-border">
                            @include('front.pages.include.product_checkout')
                            @if(count($products)>0)
                                <button type="button" class="button pull-right orderBtn">Place Order</button>
                            @endif
                        </div>
                    </form>
                @else
                    <h3 class="checkout-sep">6. Order Review</h3>
                    <div class="box-border">
                        @include('front.pages.include.product_checkout')
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script language="JavaScript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"
            type="text/javascript"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            if ($.cookie("url")) {
                $.removeCookie("url");
            }
        });

        $(document).on('submit', '#shippingAddressForm', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: "{{ route('post:shipping_address') }}",
                data: $(this).serialize(),
                beforeSend: function () {
                    $(".shippingBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                    $(".shippingBtn").attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        $('#shippingAddressForm')[0].reset();
                        $(".shippingBtn").html('Continue');
                        $(".shippingBtn").attr('disabled', false);
                        location.reload();
                    }
                    if (result.error == true) {
                        $.each(result.message, function (index, error) {
                            var keys = Object.keys(result.message);
                            $('input[name="' + keys[0] + '"]').focus();
                            $('.' + index + '_error').html(error);
                        });
                        $(".shippingBtn").html('Continue');
                        $(".shippingBtn").attr('disabled', false);
                    }
                }
            });
        });

        $(document).on('click', '.orderBtn', function (e) {
            if (!$('.address').hasClass('selected')) {
                $.notify("Shipping address not found..!!", "error");
                $('html, body').animate({
                    scrollTop: $("#OrderPlaceForm").offset().top
                }, 1000);
                return false;
            } else {
                swal({
                        title: "Are you sure?",
                        text: "You want to place this order!",
                        type: "success",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Yes!",
                        cancelButtonText: "Cancel!",
                        closeOnConfirm: true,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $('.orderBtn').removeAttr('type');
                            $('.orderBtn').attr('type', 'submit');
                            $('#OrderPlaceForm').append('<input type="hidden" name="shipping_charge" value="5">')
                            $('#OrderPlaceForm').submit();
                        } else {
                            swal("Cancelled", "Your Order is safe :)", "error");
                        }
                    });
            }
        });

        $(document).on('change', '.shipping-type', function (e) {
            e.preventDefault();
            var price = $(this).attr('price');
            var total = $('span.totalPrice').attr('total');
            var result = parseInt(price) + parseInt(total);
            $('.totalPrice').html(result);
            $('#OrderPlaceForm').append('<input type="hidden" name="amount" value="' + result + '">');
        });


        $(document).on('click', '.add-address', function (e) {
            e.preventDefault();
            var modal = $('#defaultModal');
            setTimeout(function () {
                modal.modal('show');
            }, 230);
            $.ajax({
                type: 'get',
                url: "{{ route('get:shipping_address_form') }}",
                success: function (result) {
                    $('.modal-title').html('Add Shipping Address');
                    $('.modal-body').html(result);
                }
            });
        });

        $(document).on('click', '.icon-Delete', function (e) {
            e.preventDefault();
            var shippingId = $(this).attr('shippingId');
            $.ajax({
                type: 'get',
                url: "{{ route('get:delete_shipping_address') }}",
                data: {shippingId: shippingId},
                success: function (result) {
                    if (result.success == true) {
                        location.reload();
                    }
                    if (result.error == true) {
                        $.notify("Shipping address not found..!!", "error");
                    }
                }
            });
        });


        $("#loginForm").validate({
            rules: {
                username_or_mobile: 'required',
                password: 'required'
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



        $('.addressBtn').on('click', function (e) {
            e.preventDefault();
            $('.address').removeClass('selected');
            $(this).addClass('selected');
            var shippingId = $(this).attr('shippingId');
            $.ajax({
                type: 'get',
                url: "{{ route('get:select_shipping_address') }}",
                data: {shippingId: shippingId},
                success: function (result) {
                    if (result.success == true) {
                        $.notify("Shipping address selected..!!", "success");
                    }
                    if (result.error == true) {
                        $.notify("Shipping address not selected something is wrong..!!", "error");
                    }
                }
            });
        });
    </script>
@endsection