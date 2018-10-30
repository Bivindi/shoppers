@extends('front.layout.default')

@section('title')
    Successful Order
@endsection
@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/style.css') }}"/>
    <style>

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
                <span class="navigation_page">Order Placed</span>
            </div>
            <!-- ./breadcrumb -->
            <!-- page heading-->
            <h2 class="page-heading">
                <span class="page-heading-title2">Order Placed</span>
            </h2>
            <!-- ../page heading-->
            <div class="page-content checkout-page">
                <div class="box-border">
                    @if(count($orders)>0)
                        <table class="table table-bordered table-responsive cart_summary">
                            <thead>
                            <tr>
                                <th class="cart_product">Product</th>
                                <th>Name</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Unit price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $product)
                                <tr>
                                    <td class="cart_product">
                                        <a href="{{ route('get:product_detail', $product->slug) }}"><img
                                                    src="{{ asset('100ProductImg/'.$product->product_img) }}"
                                                    alt="Product"></a>
                                    </td>
                                    <td class="cart_description">
                                        <p class="product-name"><a
                                                    href="{{ route('get:product_detail', $product->slug) }}">{{ $product->name }} </a>
                                        </p>
                                    </td>
                                    <td class="cart_avail">
                                        {{ $product->color }}
                                    </td>
                                    <td class="cart_avail">
                                        {{ $product->size }}
                                    </td>
                                    <td class="price">
                                        <span>{{ $product->price }} <i class="fa fa-inr"></i></span>
                                    </td>

                                    <td class="qty">
                                        <span class="order_qty">{{ $product->quantity }}</span>
                                    </td>
                                    <td class="price">
                                        <span>{{ $product->price * $product->quantity }} <i
                                                    class="fa fa-inr"></i></span>
                                    </td>
                                    <td class="qty">
                                        <button class="btn btn-success btn-md">
                                            Success
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="2" rowspan="2"></td>
                                <td colspan="4">Total products (tax incl.)</td>
                                <td colspan="2">{{ $product->total }} <i class="fa fa-inr"></i>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"><strong>Total</strong></td>
                                <td colspan="2">
                                    <strong>{{ $product->total }} <i class="fa fa-inr"></i></strong></td>
                            </tr>
                            </tfoot>
                        </table>
                    @else
                        <h4 class="text-center">No order place</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script type="text/javascript">
        $(window).on('load', function () {
            var status = '{{ $orders[0]->status }}';
            showAndroidToast(status);

            function showAndroidToast(status) {
                Android.showAndroid(status);
            }
        });
    </script>
@endsection