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
                <span class="navigation_page">My Orders</span>
            </div>
            <!-- ./breadcrumb -->
            <!-- page heading-->
            <h2 class="page-heading no-line">
                <span class="page-heading-title2">My Orders</span>
            </h2>
            <!-- ../page heading-->
            <div class="page-content page-order">
                <ul class="step">
                    <li class="current-step"><a class="changesec" id="1"><span>01. Wallet</span></a></li>
                    <!--<li><a class="changesec" id="2"><span>02. Recharge</span></a></li>-->
                    <li><a class="changesec" id="3"><span>02. products</span></a></li>
                </ul>
                <div class="col-md-12 dataprof" style="padding: 1%;color: #908c8c;" id="sec1">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Description</th>
                            <th scope="col">Withdrawal</th>
                            <th scope="col">Deposit</th>
                            <th scope="col">Status</th>
                            <th scope="col">Price</th>
                            <th scope="col">Order No.</th>
                            <th scope="col">Order Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($walletOrders as $key => $walletOrder)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>Paytm Balance for Rs. {{ $walletOrder->amount }}</td>
                                <td>@if($walletOrder->tran_type == \App\Model\WalletHistory::DEBIT)
                                        Rs. {{ $walletOrder->amount }} @else - @endif</td>
                                <td>@if($walletOrder->tran_type == \App\Model\WalletHistory::CREDIT)
                                        Rs. {{ $walletOrder->amount }} @else - @endif</td>
                                <td><span class="success"></span> Successful</td>
                                <td> Rs.{{ $walletOrder->amount }}</td>
                                <td>{{ $walletOrder->transaction_id }}</td>
                                <td> Rs.{{ $walletOrder->amount }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $walletOrders->links() }}
                </div>
                <div class="col-md-12 dataprof" style="padding: 1%;color: #908c8c;display: none;" id="sec2">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Price</th>
                            <th scope="col">Order No.</th>
                            <th scope="col">Order Total</th>
                            <th scope="col">Invoice</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rechargeOrders as $key => $rechargeOrder)
                            <a class="table-row" href="/mylink">
                                <tr class="rechargeDetails" orderId="{{ $rechargeOrder->transaction_id }}"
                                    style="cursor: pointer;">
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>Recharge of {{ $rechargeOrder->operator }}
                                        Mobile {{ $rechargeOrder->recharge_num }}</td>
                                    <td>@if($rechargeOrder->status == \App\Model\RechargeHistory::SUCCESS) <span
                                                class="success"></span>
                                        Successful @elseif($rechargeOrder->status == \App\Model\RechargeHistory::PENDING)
                                            <span class="pending"></span>  Pending @else <span class="failed"></span>
                                            Failed @endif</td>
                                    <td>Rs.{{ $rechargeOrder->amount }}</td>
                                    <td>{{ $rechargeOrder->transaction_id }}</td>
                                    <td>Rs.{{ $rechargeOrder->amount }}</td>
                                    @if($rechargeOrder->status == \App\Model\RechargeHistory::SUCCESS)
                                        <td>
                                            <a href="{{ route('get:recharge_details', $rechargeOrder->transaction_id) }}">Invoice</a>
                                        </td>
                                    @else
                                        <td>-</td>
                                    @endif
                                </tr>
                            </a>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $rechargeOrders->links() }}
                </div>
                <div class="col-md-12 dataprof" style="padding: 1%;color: #908c8c;display: none;" id="sec3">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Order No.</th>
                            <th scope="col">Order Total</th>
                            <th scope="col">Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productOrders as $key => $productOrder)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td> {{ $productOrder->name }}</td>
                                <td>@if($productOrder->status == \App\Model\RechargeHistory::SUCCESS) <span
                                            class="success"></span>
                                    Successful @elseif($productOrder->status == \App\Model\RechargeHistory::PENDING)
                                        <span class="pending"></span>  Pending @else <span class="failed"></span>
                                        Failed @endif</td>
                                <td>{{ $productOrder->quantity }}</td>
                                <td>Rs.{{ $productOrder->price * $productOrder->quantity  }}</td>
                                <td>{{ $productOrder->transaction_id }}</td>
                                <td>Rs.{{ $productOrder->price * $productOrder->quantity  }}</td>
                                <td>
                                    <a href="{{ route('get:order_details', $productOrder->transaction_id) }}">Details</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $productOrders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script src="{{ asset('front/assets/js/picker.js') }}"></script>
    <script src="{{ asset('front/assets/js/picker.date.js') }}"></script>
    <script>
        $(function () {
            $('.box-addres').click(function () {
                if ($(this).hasClass('addres-active')) {

                }
                else {
                    $(this).addClass('addres-active');
                    $(this).siblings().removeClass('addres-active');
                    $(this).siblings().children().removeAttr('checked');
                    $(this).children().prop("checked", true);
                    var selectedValue = $("input[name='address']:checked").val();
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

                }

            });

            $('.changesec').click(function () {
                var idd = $(this).attr('id');
                $('.current-step').removeClass('current-step');
                $(this).parent().addClass('current-step');
                $(".dataprof").hide();
                var data = "sec" + idd;
                $("#" + data).css('display', 'block');
            });
        });
    </script>
@endsection