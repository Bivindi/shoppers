@extends('front.auth.layout.default')
@section('title')
    MyOrder
@endsection
@section('page-css')
    <link rel="stylesheet" href="{{ asset('front/assets/css/default.date.css') }}">
    <style>
        .col-md-4 div strong {
            color: #696767;
        }

        .dataprof table#profile-table {
            display: inline-block;
        }

        .text-right-prof {
            text-align: right;
            border-right-style: solid;
            border-right-color: #fff;
            border-right-width: thick;
            margin-right: 10px;
        }

        .box-addres {
            box-shadow: 0px 2px 1px 1px #d0cece;
        }

        .addres-active {
            box-shadow: 0px 2px 1px 1px #077bd0;
        }

        .step li {
            cursor: pointer;
        }

        .pro {
            display: inline-block;
            float: right;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .box-authentication input, .box-authentication textarea {
            width: 100% !important;
        }

        .lable {
            color: #ffffff;
        }

        .order-details {
            color: #878787;
            text-transform: uppercase;
            padding: 24px 24px 0;
        }

        .success {
            background: #7ed321;
            border-radius: 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            margin: 4px 10px 0 0;
            width: 15px;
            height: 15px;
            float: left !important;
        }

        .pending {
            background: #FFFF00;
            border-radius: 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            margin: 4px 10px 0 0;
            width: 15px;
            height: 15px;
            float: left !important;
        }

        .failed {
            background: red;
            border-radius: 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            margin: 4px 10px 0 0;
            width: 15px;
            height: 15px;
            float: left !important;
        }

        ._2m1Usk {
            padding: 20px 0px 0px 20px;
        }

        ._2ebRXN {
            margin-bottom: 10px;
        }

        ._2m1Usk .eYgzGn {
            color: #878787;
        }

        ._2kIypH ._2QEGRr ._3WyGKy {
            padding: 24px 24px;
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08);
        }

        ._1GRhLX {
            background-color: #fff;
            border-radius: 2px;
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08);
        }

        .block {
            padding: 24px;
            padding-left: 0;
            padding-right: 0;
        }

        ._1MbX3l {
            font-weight: 500;
        }

        ._3N_1fR {
            padding-top: 10px;
        }

        ._1GAUB_ {
            padding-top: 10px;
        }

        ._3eXX5M {
            padding-left: 10px;
        }

        ._1S3Y5S {
            padding-bottom: 10px;
            font-weight: 500;
            margin-left: -10px;
            width: auto;
        }

        ._1S3Y5S, ._APNAc {
            color: #2874f0;
        }

        .block:first-child {
            border-left: none;
        }

        .dataprof {
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08);
            background-color: #f0f3f6;
            border-radius: 2px;
            padding: 0px;
        }

        ._2GcYu- {
            font-size: 12px;
            padding-left: 5px;
        }

        ._3OsVcL {
            padding-left: 14px;
        }

        ._3Q4GqT {
            height: 23px;
            width: 18px;
            margin: 0 13px;
            cursor: pointer;
        }

        ._3zvrLw {
            text-transform: uppercase;
            cursor: pointer;
            line-height: 24px;
            width: auto;
        }

        .product {
            margin-top: 2%;
            position: relative;
        }

        ._2eFO7I {
            text-align: center;
            max-width: 120px;
            margin-right: 16px;
        }

        .NPoy5u {
            cursor: pointer;
            box-shadow: none;
            padding: 0;
            border: none;
            font-size: 14px;
            text-decoration: none;
            color: #212121;
            margin-bottom: 10px;
            font-weight: 400;
        }

        ._3Vj7el {
            color: #878787;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .f3C4Tt {
            position: relative;
            font-weight: 500;
            font-size: 16px;
            padding-left: 2%;
        }

        ._3JuTif {
            padding-top: 17px;
        }

        ._1S3Y5S {
            padding-bottom: 10px;
            font-weight: 500;
            margin-left: -10px;
            width: auto;
        }

        .bs-wizard {
            margin-top: 40px;
        }

        /*Form Wizard*/
        .bs-wizard {
            border-bottom: solid 1px #e0e0e0;
            padding: 0 0 10px 0;
        }

        .bs-wizard > .bs-wizard-step {
            padding: 0;
            position: relative;
        }

        .bs-wizard > .bs-wizard-step + .bs-wizard-step {
        }

        .bs-wizard > .bs-wizard-step .bs-wizard-stepnum {
            color: #595959;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .bs-wizard > .bs-wizard-step .bs-wizard-info {
            color: #999;
            font-size: 14px;
        }

        .bs-wizard > .bs-wizard-step > .bs-wizard-dot {
            position: absolute;
            width: 30px;
            height: 30px;
            display: block;
            background: #fbe8aa;
            top: 45px;
            left: 50%;
            margin-top: -15px;
            margin-left: -15px;
            border-radius: 50%;
        }

        .bs-wizard > .bs-wizard-step > .bs-wizard-dot:after {
            content: ' ';
            width: 14px;
            height: 14px;
            background: #fbbd19;
            border-radius: 50px;
            position: absolute;
            top: 8px;
            left: 8px;
        }

        .canceled {
            background: red !important;
        }

        .bs-wizard > .bs-wizard-step > .progress {
            position: relative;
            border-radius: 0px;
            height: 8px;
            box-shadow: none;
            margin: 20px 0;
        }

        .bs-wizard > .bs-wizard-step > .progress > .progress-bar {
            width: 0px;
            box-shadow: none;
            background: #fbe8aa;
        }

        .bs-wizard > .bs-wizard-step.complete > .progress > .progress-bar {
            width: 100%;
        }

        .bs-wizard > .bs-wizard-step.active > .progress > .progress-bar {
            width: 50%;
        }

        .bs-wizard > .bs-wizard-step:first-child.active > .progress > .progress-bar {
            width: 0%;
        }

        .bs-wizard > .bs-wizard-step:last-child.active > .progress > .progress-bar {
            width: 100%;
        }

        .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot {
            background-color: #f5f5f5;
        }

        .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot:after {
            opacity: 0;
        }

        .bs-wizard > .bs-wizard-step:first-child > .progress {
            left: 50%;
            width: 50%;
        }

        .bs-wizard > .bs-wizard-step:last-child > .progress {
            width: 50%;
        }

        .bs-wizard > .bs-wizard-step.disabled a.bs-wizard-dot {
            pointer-events: none;
        }

        ._3YJBAw {
            width: 100%;
            margin-bottom: 10px;
        }

        ._2BU9FV {
            padding: 0 10px 10px 10px;
            width: 45px;
        }

        ._1XR3uz {
            margin-top: 10px;
            padding-right: 10px;
        }

        .mU1-I_ {
            text-decoration: line-through;
        }

        ._1OJGFU {
            border-top: 1px solid #f0f0f0;
            padding: 10px 24px;
            text-align: right;
        }

        ._11dQu7 {
            display: inline-block;
            min-width: 30%;
            width: auto;
            text-align: left;
            padding: 10px 10px 10px 8px;
        }

        ._27lDDD {
            font-size: 16px;
            font-weight: 500;
        }

        ._1B26g2 {
            font-size: 16px;
            font-weight: 500;
            padding-left: 20px;
        }

        ._2HvExN {
            padding: 20px 0px 0px 20px;
        }

        /*END Form Wizard*/
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
                <span class="navigation_page">Your Orders</span>
                <span class="navigation-pipe">&nbsp;</span>
                <span class="navigation_page">Orders Details</span>
            </div>
            <!-- ./breadcrumb -->
            <!-- page heading-->
            <h2 class="page-heading no-line">
                <span class="page-heading-title2">Order Details</span>
            </h2>
            <!-- ../page heading-->
            <div class="page-content page-order">
                <ul class="step">
                    <li class="current-step"><a class="changesec" id="1"><span>01. Order Details</span></a></li>
                </ul>
                <div class="col-md-12 col-xs-12 dataprof" id="sec1">
                    <div class="col-sm-4 col-xs-12 block">
                        <span class="order-details">Order Details</span>
                        <div class="_2m1Usk">
                            <div class="row _2ebRXN">
                                <div class="col-sm-3 _1hrSE-">
                                    <span class="eYgzGn">Order ID</span>
                                </div>
                                <div class="col-sm-8">
                                    <div>{{ $productOrder->transaction_id }}<span
                                                class="_2GcYu-">({{ $productOrder->quantity }} item)</span></div>
                                </div>
                            </div>
                            <div class="row _2ebRXN">
                                <div class="col-sm-3 _1hrSE-"><span class="eYgzGn">Order Date</span></div>
                                <div class="col-sm-8">{{ \Carbon\Carbon::parse($productOrder->created_at)->format("D dS M 'y H:i A") }}</div>
                            </div>
                            <div class="row _2ebRXN">
                                <div class="col-sm-3 _1hrSE-"><span class="eYgzGn">Total Amount</span></div>
                                <div class="col-sm-8">
                                    <div><span>₹{{ $productOrder->price }}</span><span
                                                class="_1brAgx"> through {{ $productOrder->shipping_method }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row _2ebRXN">
                                <div class="col-sm-3 _1hrSE-"></div>
                                <div class="col-sm-8"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-12 block">
                        <span class="order-details">Address</span>
                        <div class="_2m1Usk">
                            <div class="row _2ebRXN">
                                <div class="col-5-12 _3dynR2 _3OsVcL">
                                    <div class="_1MbX3l">Mokariya Sanjay</div>
                                    <div class="wRBMLW">sanjaymokariya48@outlook.in</div>
                                    <div class="_3N_1fR">
                                        {{ $address->address }},
                                        {{ $address->city }}
                                        <br>
                                        -{{ $address->pin_code }}
                                        {{ $address->state }}
                                    </div>
                                    <div class="_1GAUB_"><span class="_1MbX3l">Phone</span><span
                                                class="_3eXX5M">{{ $address->mobile_num }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-12 block">
                        <span class="order-details">MANAGE ORDER</span>
                        <div class="_2m1Usk">
                            <div class="_2ebRXN">
                                <div class="col-3-12 _3dynR2">
                                    <div>
                                        <div class="_1S3Y5S row">
                                            <svg fill="#2874F1" height="24" viewBox="0 0 24 24" width="24"
                                                 xmlns="http://www.w3.org/2000/svg" class="_3Q4GqT col-1-5">
                                                <path d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"></path>
                                            </svg>
                                            @if($productOrder->status == \App\Model\Order::SUCCESS)
                                                <a href="{{ route('get:product_order_invoice', $productOrder->transaction_id) }}"
                                                   target="_blank"><span
                                                            class="_3zvrLw col-3-5">Download Invoice</span></a>
                                            @else
                                                <span class="_3zvrLw col-3-5 disabled">Download Invoice</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 dataprof product">
                    <div class="col-sm-4 col-xs-12 block">
                        <div class="col-sm-3 _2eFO7I"><a
                                    href="{{ route('get:product_detail', $productOrder->slug) }}"
                                    target="_blank" rel="noopener noreferrer">
                                <div class="_3BTv9X" style="height: 75px; width: 75px;">
                                    <img class="_1Nyybr  _30XEf0" alt=""
                                         src="{{ asset('100ProductImg/'.$productOrder->product_img) }}">
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-8">
                            <a class="_2AkmmA NPoy5u"
                               href="{{ route('get:product_detail', $productOrder->slug) }}"
                               target="_blank">{{ $productOrder->name }}</a>
                            @if($productOrder->color)
                                <div class="_3Vj7el">
                                <span class="_3PqwaQ">
                                    <span class="_3Vj7el">Color: </span>
                                    <span class="_14N9bh">{{ $productOrder->color }}</span>
                                </span>
                                    <span class="_3PqwaQ"></span>
                                </div>
                            @endif
                            @if($productOrder->size)
                                <div class="_3Vj7el">
                                <span class="_3PqwaQ">
                                    <span class="_3Vj7el">Size: </span>
                                    <span class="_14N9bh">{{ $productOrder->size }}</span>
                                </span>
                                    <span class="_3PqwaQ"></span>
                                </div>
                            @endif
                            <div class="_3Vj7el">10 Days Replacement</div>
                            <div class="_3Vj7el">
                                <span class="_3Vj7el _3cWeIX">Seller: </span>
                                <a href="javascript:void(0);" class="_2MePjZ">
                                    @if($productOrder->username == 'admin')
                                        LozyPay @else {{ $productOrder->username }}
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-12 block">
                        <div class="row bs-wizard" style="border-bottom:0;">

                            <div class="col-xs-3 bs-wizard-step complete">
                                <div class="text-center bs-wizard-stepnum">Ordered</div>
                                <div class="progress">
                                    <div class="progress-bar"></div>
                                </div>
                                <a href="#" class="bs-wizard-dot"></a>
                                <div class="bs-wizard-info text-center">
                                    Your Order has been placed.
                                    {{ \Carbon\Carbon::parse($productOrder->created_at)->format("D, dS M H:I A") }}
                                </div>
                            </div>
                            <div class="col-xs-3 bs-wizard-step @if($productOrder->getDispatchDate(\App\Model\Order::DISPATCH)) complete @else disabled @endif">
                                <div class="text-center bs-wizard-stepnum">@if($productOrder->status == \App\Model\Order::CANCELED)
                                        Cancelled @else Dispatch @endif</div>
                                <div class="progress">
                                    <div class="progress-bar"></div>
                                </div>
                                <a href="#"
                                   class="bs-wizard-dot @if($productOrder->status == \App\Model\Order::CANCELED) canceled @endif"></a>
                                <div class="bs-wizard-info text-center">
                                    @if($productOrder->status == \App\Model\Order::CANCELED)
                                        {{ \Carbon\Carbon::parse($productOrder->updated_at)->format("D, dS M H:I A") }}
                                    @else
                                        {{ $productOrder->getDispatchDate(\App\Model\Order::DISPATCH) }}
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-3 bs-wizard-step @if($productOrder->getDispatchDate(\App\Model\Order::ONTHEWAY)) complete @else disabled @endif">
                                <!-- complete -->
                                <div class="text-center bs-wizard-stepnum">ON The Way</div>
                                <div class="progress">
                                    <div class="progress-bar"></div>
                                </div>
                                <a href="#" class="bs-wizard-dot"></a>
                                <div class="bs-wizard-info text-center">
                                    @if($productOrder->status != \App\Model\Order::CANCELED)
                                        {{ $productOrder->getDispatchDate(\App\Model\Order::ONTHEWAY) }}
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-3 bs-wizard-step @if($productOrder->getDispatchDate(\App\Model\Order::DELIVERED)) complete @else disabled @endif">
                                <!-- active -->
                                <div class="text-center bs-wizard-stepnum">DELIVERED</div>
                                <div class="progress">
                                    <div class="progress-bar"></div>
                                </div>
                                <a href="#" class="bs-wizard-dot"></a>
                                <div class="bs-wizard-info text-center">
                                    @if($productOrder->status != \App\Model\Order::CANCELED)
                                        {{ $productOrder->getDispatchDate(\App\Model\Order::DELIVERED) }}
                                        <br>
                                        Your item has been delivered
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-12 block">
                        <div class="_2HvExN">
                            <div class="f3C4Tt">₹{{ $productOrder->price }}
                            </div>
                            <div class="_3JuTif">
                                <a href="{{ route('get:product_detail', $productOrder->slug) }}" class="_1S3Y5S">
                                    <img src="{{ asset('img/download.svg') }}" class="_3Q4GqT col-1-5">
                                    <span class="_3zvrLw col-3-5">Rate &amp; Review Product</span></a>
                            </div>
                            @if($productOrder->status != \App\Model\Order::CANCELED && $productOrder->shipping != \App\Model\Order::DELIVERED)
                                <div class="_1S3Y5S  cancelItem" transId="{{ $productOrder->transaction_id }}">
                                    <img src="{{ asset('img/cancel.svg') }}"
                                         class="_3Q4GqT col-1-5">
                                    <span class="_3zvrLw col-3-5">Cancel Item</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="_3YJBAw">
                            <div class="">
                                <span class="col-3-12 _2BU9FV"><img
                                            src="{{ asset('img/shipping.svg') }}"
                                            class="_333iJH"></span><span class="col-9-12 _1XR3uz">
                                    <span class="@if($productOrder->status == \App\Model\Order::CANCELED) mU1-I_ @endif">Delivery expected by {{ \Carbon\Carbon::parse($productOrder->created_at)->format("D, M dS 'y") }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 dataprof">
                    <div class="_1OJGFU">
                        <div class="_11dQu7"><span class="_27lDDD">Total</span><span
                                    class="_1B26g2">₹{{ $productOrder->price }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script>
        $(document).on('click', '.cancelItem', function (e) {
            e.preventDefault();
            var transId = $(this).attr('transId');
            var modal = $('#defaultModal');
            setTimeout(function () {
                modal.modal('show');
            }, 230);
            $.ajax({
                type: 'get',
                url: "{{ route('get:cancel_item_form') }}",
                data: {transId: transId},
                success: function (result) {
                    if (result.success == false) {
                        $.notify(result.message, "error");
                    }
                    $('.modal-title').html('Request Cancellation');
                    $('.modal-body').html(result);
                }
            });
        });
    </script>
@endsection