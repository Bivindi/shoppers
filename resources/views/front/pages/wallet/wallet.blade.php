@extends('front.layout.default')
@section('title')
    LozyPay Wallet
@endsection
@section('metadescription')
    LozyPay Wallet
@endsection

@section('page-css')
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

        [class*=" icon-"], [class^=icon-] {
            font-family: icomoon !important;
            speak: none;
            font-style: normal;
            font-weight: 400;
            font-variant: normal;
            text-transform: none;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .icon-paytm-wallet:before {
            content: "\e98b";
            color: #00b9f5;
        }

        .wallet-price span.value {
            font-size: 18px;
            font-weight: 600;
            display: block;
        }

        .bigContainer-profile {
            border: 1px solid #DEEAEE;
            background: #fff;
            border-radius: 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            padding: 20px;
            margin-bottom: 15px;
        }

        .wallet-price {
            color: #000;
            border-right: 1px dotted #DEEAEE;
        }

        .wallet-money {
            margin-top: 5px;
        }

        .wallet-to-wallet {
            font-size: 13px;
            padding-top: 5px;
            font-weight: 600 !important;
            color: #ff9800 !important;
            display: inline-block;
        }

        #addWalletBtn {
            text-align: center;
            background: #FFA13B;
            color: #fff;
            border: 1px solid #FFA13B;
            padding: 10px 20px;
            display: block;
        }

        #walletToWalletBtn {
            text-align: center;
            background: #FFA13B;
            color: #fff;
            border: 1px solid #FFA13B;
            padding: 10px 20px;
            display: block;
        }

        .page-content input, .page-content select, .page-content textarea {
            border-radius: 0;
            border-color: #eaeaea;
            box-shadow: inherit;
            outline: 0 none;
        }
    </style>
@endsection

@section('page-content')
    
    <section class="wishlist-slider-section  wd-slider-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h1 class="wishlist-slider-title">Wallet</h1>
                        <div class="page-location pt-0">
                            <ul>
                                <li><a href="{{ url('') }}">
                                    Home <span class="divider">/</span>
                                </a></li>
                                <li><a class="page-location-active" href="#">
                                    <span class="active-color">Your Wallet</span>
                                    <span class="divider">/</span>
                                </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="columns-container" style="background: #F5F5F5;">
        <br>
        <div class="container" id="columns">
            <!-- breadcrumb -->
            <!-- <div class="breadcrumb clearfix">
                <a class="home" href="#" title="Return to Home">Home</a>
                <span class="navigation-pipe">&nbsp;</span>
                <span class="navigation_page">Your Wallet</span>
            </div> -->
            <!-- ./breadcrumb -->
            <!-- page heading-->
            <!-- <h2 class="page-heading no-line">
                <span class="page-heading-title2">Wallet</span>
            </h2> -->
            <!-- ../page heading-->
            <div class="page-content page-order">
                <div class="bigContainer-profile">
                    <div class="row">
                        <form action="{{ route('get:add_money_wallet') }}" id="WalletForm" method="get" style="width: 100%;">
                            {{ csrf_field() }}
                            <div class="col-md-12 dataprof" style="color: #908c8c;" id="wallet">
                                <div class="row">
                                    <div class="col-sm-4 wallet-price">
                                        <span class="value">Rs @if(\Illuminate\Support\Facades\Auth::user()->wallet_amount){{ \Illuminate\Support\Facades\Auth::user()->wallet_amount }} @else
                                            0 @endif</span><span class="text">Your Wallet Balance</span>
                                    </div>
                                    <div class="col-sm-4">
                                        <input maxlength="6" required name="amount" class="form-control input-md wallet-money" tabindex="0"
                                               placeholder="Enter Amount to be Added in Wallet" aria-invalid="false">
                                        <span class="error">{{ $errors->first('amount') }}</span>
                                    </div>
                                    <div class="col-sm-4">
                                        <button class="wallet-money" id="addWalletBtn" type="submit">Add Money to
                                            Wallet
                                        </button>
                                        <a href="javascript:void(0);" class="wallet-to-wallet" id="walletToWallet">Wallet to
                                            wallet</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
@endsection
@section('page-js')
    <script>
        $(document).on('click', '#walletToWallet', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'get',
                url: "{{ route('get:wallet_to_wallet_form') }}",
                beforeSend: function () {
                    $(".bigContainer-profile").html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw text-center"></i></div>');
                },
                success: function (result) {
                    $('.bigContainer-profile').html(result);
                }
            });
        });

        $(document).on('submit', '#walletToWalletForm', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: "{{ route('post:wallet_to_wallet_money') }}",
                data: $(this).serialize(),
                beforeSend: function () {
                    $("#walletToWalletBtn").html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-1x fa-fw text-center"></i></div>');
                    $("#walletToWalletBtn").attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        $("#walletToWalletBtn").html('Add Wallet to Wallet Money');
                        $("#walletToWalletBtn").attr('disabled', false);
                        location.reload();
                    }
                    if (result.success == false) {
                        $.notify(result.message, "error");
                        $("#walletToWalletBtn").html('Add Wallet to Wallet Money');
                        $("#walletToWalletBtn").attr('disabled', false);
                    }
                    if (result.error == true) {
                        $.each(result.message, function (index, error) {
                            var keys = Object.keys(result.message);
                            $('input[name="' + keys[0] + '"]').focus();
                            $('.' + index + '_error').html(error);
                        });
                        $("#walletToWalletBtn").html('Add Wallet to Wallet Money');
                        $("#walletToWalletBtn").attr('disabled', false);
                    }
                }
            });
        });
    </script>
@endsection