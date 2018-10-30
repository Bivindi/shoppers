@extends('front.auth.layout.default')

@section('title')
    Payment
@endsection
@section('page-css')
    <style>
        .lightTxt {
            font-weight: 100;
            font-size: 18px !important;
            display: inline-block;
        }

        .titletext {
            font-size: 18px !important;
        }

        .walletCheckbox, .DigitalCardCheckbox {
            padding-right: 8px;
        }

        .walletCheckbox {
            margin-top: -3px;
        }

        .fl {
            float: left !important;
        }

        .bootstrap-checkbox button {
            background: transparent;
            border: 0;
            padding: 0;
        }

        .totalWalletBal {
            display: block;
            position: absolute;
            left: 43px;
            margin-top: 9px;
        }

        .mb50 {
            margin-bottom: 50px;
        }

        .lightTxt {
            font-weight: 100;
        }

        .small, .small * {
            font-size: 12px !important;
        }

        .cb-icon-check {
            background-position: -209px -40px;
        }

        .tick {
            display: block;
            width: 26px;
            height: 26px;
            background: url(https://staticgw5.paytm.in/1.14.1.2/images/web/merchant4/sprite_compressed.png) no-repeat -209px -67px;
            cursor: pointer;
        }

        .topBorder {
            border-top: 1px solid #efefef;
            margin-left: -21px;
            width: 100%;
            padding-left: 42px;
        }

        .mt20 {
            margin-top: 20px;
        }

        .checkbox label:after,
        .radio label:after {
            content: '';
            display: table;
            clear: both;
        }

        .checkbox .cr,
        .radio .cr {
            position: relative;
            display: inline-block;
            border: 1px solid #a9a9a9;
            border-radius: .25em;
            width: 1.3em;
            height: 1.3em;
            float: left;
            margin-right: .5em;
        }

        .radio .cr {
            border-radius: 50%;
        }

        .checkbox .cr .cr-icon,
        .radio .cr .cr-icon {
            position: absolute;
            font-size: .8em;
            line-height: 0;
            top: 50%;
            left: 20%;
        }

        .radio .cr .cr-icon {
            margin-left: 0.04em;
        }

        .checkbox label input[type="checkbox"],
        .radio label input[type="radio"] {
            display: none;
        }

        .checkbox label input[type="checkbox"] + .cr > .cr-icon,
        .radio label input[type="radio"] + .cr > .cr-icon {
            transform: scale(3) rotateZ(-20deg);
            opacity: 0;
            transition: all .3s ease-in;
        }

        .checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
        .radio label input[type="radio"]:checked + .cr > .cr-icon {
            transform: scale(1) rotateZ(0deg);
            opacity: 1;
        }

        .checkbox label input[type="checkbox"]:disabled + .cr,
        .radio label input[type="radio"]:disabled + .cr {
            opacity: .5;
        }

        .relative {
            position: relative;
        }

        .payAmount {
            background-color: #fafafa;
            border-radius: 5px;
            margin: 5px 10px;
            overflow: hidden;
            padding: 13px 13px 18px 13px;
            box-sizing: border-box;
            position: relative;
        }

        #paymentBox .card {
            padding: 4px 20px;
        }

        .payAmount .card, .payCreditCard .card, .payAmount .card, .paymentBank .card {
            border: #deeaee solid 1px;
        }

        .mt10 {
            margin-top: 10px;
        }

        .mt6 {
            margin-top: 6px;
        }

        .paybox {
            background: #fff;
            width: 100%;
            border-radius: 4px;
            height: 56px;
            position: relative;
            padding: 4px 20px;
        }

        .card {
            padding: 10px 20px;
            margin: 15px 0;
            position: relative;
        }

        .sign {
            height: 100px;
            float: left;
            text-align: center;
            display: block;
        }

        .minus, .equal {
            margin-top: 22px;
            color: #000;
            font-size: 35px;
            display: inline-block;
        }

        .titletext {
            font-size: 18px !important;
        }

        .b {
            font-weight: 600;
        }

        .small, .small * {
            font-size: 12px;
        }

        .mt7 {
            margin-top: 7px;
        }

        .mt {
            margin-top: 29px;
        }

        .proceed-to-pay {
            float: right;
            background: #ff3366;
            color: #fff;
            border: 1px solid #ff3366;
            padding: 10px 20px;
        }

        .proceed-to-pay:hover {
            color: #fff;
        }

        .no-wallet-money {
            padding: 4px;
            font-weight: 400;
            border: none;
            color: #222;
            font-size: 12px;
            margin-top: 10px;
            padding-left: 8px;
            padding-right: 10px;
            background: #f9ffcf;
            margin-left: -5px;
            width: 302px;
        }

        .walletSwitchBox {
            width: 230px;
            margin-right: 50px;
            border-radius: 4px;
            height: 31px;
            padding: 10px 5px;
        }

        .blur-overlay {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 10;
            background: #f5f5f5;
            opacity: .4;
        }

        .mb24 {
            margin-bottom: 24px;
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
                <span class="navigation_page">Your recharge</span>
            </div>
            <div class="page-content page-order">
                <div class="row">
                    <div class="col-sm-6">
                        <span class="lightTxt">Total payment to be made :</span>
                        <span class="titletext WebRupee">Rs</span>
                        <span id="totalAmountSpan" class="titletext">{{ $recharge->amount }}</span>
                    </div>
                    <div class="col-sm-6">
                        <span class="lightTxt">Transaction ID: {{ $recharge->transaction_id }}</span>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="topBorder mt20"></div>
                <div class="order-detail-content">
                    <div class="col-sm-12 @if(\Illuminate\Support\Facades\Auth::user()->wallet_amount != 0) mb50 @else mb24 @endif">
                        <div id="cardsTabs">
                            <div class="walletSwitchBox fl relative " id="paytmWalletCheckButton"
                                 style="margin-right: 0;width: 311px;">
                                <div class="checkbox">
                                    <label style="font-size: 1em">
                                        <input type="checkbox" id="WalletCheckPayment"
                                               value="@if(\Illuminate\Support\Facades\Auth::user()->wallet_amount == 0) 0 @else 1 @endif"
                                               @if(\Illuminate\Support\Facades\Auth::user()->wallet_amount) checked @endif>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        LozyPay
                                        <div class="bal  small mt6 totalWalletBal lightTxt" id="totalWalletBalance">
                                            (Available
                                            Balance <span class=" "><span class="WebRupee">Rs</span> <span
                                                        class="amt">{{ \Illuminate\Support\Facades\Auth::user()->wallet_amount  }}</span></span>)
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::user()->wallet_amount == 0)
                        <div id="no-walletTextUpdate" class="notification no-walletTextUpdate alert fl no-wallet-money">
                            You do not have sufficient balance for this transaction
                        </div>
                        <div class="col-sm-2">
                            <form action="{{ route('get:recharge_payment') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="transId" value="{{ $recharge->transaction_id }}">
                                <button type="submit" class="proceed-to-pay">Pay now
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="col-sm-12">
                            <div class="payAmount">
                                @if(\Illuminate\Support\Facades\Auth::user()->wallet_amount < $recharge->amount)
                                    <div class="col-sm-3 mt7">
                                        <div id="hybrid-mode-paybox" class="card paybox fl">
                                            <div class="small">Payment to be made</div>
                                            <div class=" titletext  b"><span
                                                        class="titletext b WebRupee">Rs</span> {{ $recharge->amount }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-sm-3 mt7">
                                        <div id="hybrid-mode-paybox" class="card paybox fl">
                                            <div class="bal  small" id="yourBal" style="">
                                                Money in Your <span class="">LozyPay </span>
                                                <div class="lightTxt" style="display: block;">
                                                <span class="relative"><span
                                                            class="titletext b WebRupee">Rs</span> <span
                                                            class="amt titletext">{{ \Illuminate\Support\Facades\Auth::user()->wallet_amount }}</span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="text-center">
                                    <div id="hybrid-mode-sign text-center" class="sign"><span class="minus">-</span>
                                    </div>
                                </div>
                                @if(\Illuminate\Support\Facades\Auth::user()->wallet_amount < $recharge->amount)
                                    <div class="col-sm-3 mt7">
                                        <div id="hybrid-mode-paybox" class="card paybox fl">
                                            <div class="bal  small" id="yourBal" style="">
                                                Money in Your <span class="">LozyPay </span>
                                                <div class="lightTxt" style="display: block;">
                                                <span class="relative"><span
                                                            class="titletext b WebRupee">Rs</span> <span
                                                            class="amt titletext">{{ \Illuminate\Support\Facades\Auth::user()->wallet_amount }}</span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-sm-3 mt7">
                                        <div id="hybrid-mode-paybox" class="card paybox fl">
                                            <div class="small">Payment to be made</div>
                                            <div class=" titletext  b"><span
                                                        class="titletext b WebRupee">Rs</span> {{ $recharge->amount }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(\Illuminate\Support\Facades\Auth::user()->wallet_amount < $recharge->amount)
                                    <div class="text-center">
                                        <div class="sign text-center"><span class="equal">=</span></div>
                                    </div>
                                    <div class="col-sm-3 mt7">
                                        <div id="hybrid-mode-paybox" class="card paybox fl">
                                            <div class="small">Select an option to pay balance</div>
                                            <div class=" titletext  b"><span
                                                        class="titletext b WebRupee">Rs</span> {{ $recharge->amount - \Illuminate\Support\Facades\Auth::user()->wallet_amount }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <div class="sign text-center"><span class="equal">=</span></div>
                                    </div>
                                    <div class="col-sm-3 mt7">
                                        <div id="hybrid-mode-paybox" class="card paybox fl">
                                            <div class="small">Available balance in lozypay</div>
                                            <div class=" titletext  b"><span
                                                        class="titletext b WebRupee">Rs</span> {{ \Illuminate\Support\Facades\Auth::user()->wallet_amount - $recharge->amount }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($recharge->amount <= \Illuminate\Support\Facades\Auth::user()->wallet_amount)
                                    <form id="rechargeProcess">
                                        {{ csrf_field() }}
                                        @if(\Illuminate\Support\Facades\Auth::user()->wallet_amount < $recharge->amount)
                                            <input type="hidden" name="amount"
                                                   value="{{ \Illuminate\Support\Facades\Auth::user()->wallet_amount - $recharge->amount }}">
                                        @else
                                            <input type="hidden" name="amount"
                                                   value="{{  $recharge->amount }}">
                                        @endif
                                        <input type="hidden" name="walletAmount"
                                               value="{{ \Illuminate\Support\Facades\Auth::user()->wallet_amount }}">
                                        <input type="hidden" name="transactionId"
                                               value="{{ $recharge->transaction_id }}">
                                        <div class="col-sm-2 mt">
                                            <button type="submit" class="proceed-to-pay" id="submitBtn">Proceed to pay
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <div class="col-sm-2 mt">
                                        <form action="{{ route('get:recharge_payment') }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="transId" value="{{ $recharge->transaction_id }}">
                                            <input type="hidden" name="amount"
                                                   value="{{ $recharge->amount - \Illuminate\Support\Facades\Auth::user()->wallet_amount }}">
                                            <button type="submit" class="proceed-to-pay">Pay now</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script>
        $(document).on('submit', '#rechargeProcess', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: "{{ route('post:checkout') }}",
                data: $(this).serialize(),
                beforeSend: function () {
                    $("#submitBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                    $("#submitBtn").attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        $("#submitBtn").html('Process to pay');
                        $("#submitBtn").attr('disabled', false);
                        window.location.href = result.url
                    } else {
                        $.notify(result.message, "error");
                    }
                }
            });
        });

        $(document).on('change', '#WalletCheckPayment', function () {
            if ($(this).attr('checked')) {
                $('#rechargeProcess').hide();
                $(this).removeAttr('checked')
            } else {
                $('#rechargeProcess').show();
                $(this).attr('checked', 'checked');
            }
        });
    </script>
@endsection