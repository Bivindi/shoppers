<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Order Report</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-6">
                <img src="https://productdemo.info/payclone/public/img/lozypay.png" alt="">
            </div>
            <div class="col-sm-6" style="text-align: right;">
                <h3>{{ \Auth::user()->username }}</h3>
                <p>{{ \Auth::user()->mobile_num }}</p>
            </div>
            <span class="clear"></span>
        </div>
        <div class="col-sm-12 mt20">
            <div class="col-sm-6">
                <strong>Transaction Receipt</strong>
                <p>OrderNo. {{ $order->transaction_id }}</p>
            </div>
            <div class="col-sm-6" style="text-align: right;">
                <p>19 Mar, 2018, 03:11 PM</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="recharge" style="border: 1px solid #f3f3f3;min-height: 130px;">
                    <div class="col-sm-4 details">
                        <p>Recharge of Number</p>
                        <strong>{{ $order->recharge_num }}</strong>
                    </div>
                    <span class="clear"></span>
                    <div class="col-sm-4 details">
                        <p>Operator</p>
                        <strong>{{ $order->operator }}</strong>
                    </div>
                    <span class="clear"></span>
                    <div class="col-sm-4 details">
                        <p>Amount Paid</p>
                        <strong>Rs. {{ $order->amount }}</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="row payment-details">
            <div class="col-sm-12">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">Payment Details</div>
                        <div class="panel-body">
                            <div class="col-sm-6">Operator Reference Number</div>
                            <div class="col-sm-6">{{ $order->transaction_id }}</div>
                        </div>
                        <hr>
                        <div class="panel-body">
                            <div class="col-sm-6">Amount Paid</div>
                            <div class="col-sm-6">Rs. {{ $order->amount }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12" style="margin-top: 1%;">
            <b>Note: </b><span>This is computer generated receipt and does not require physical signature</span>
        </div>
    </div>
</div>
</body>
</html>
