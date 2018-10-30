@extends('admin.layout.default')
@section('title')
    Invoice
@endsection
@section('page-css')
@endsection

@section('page-content')
    <section id="content">
        <div id="breadcrumbs-wrapper">
            <div class="header-search-wrapper grey hide-on-large-only">
                <i class="mdi-action-search active"></i>
                <input type="text" name="Search" class="header-search-input z-depth-2"
                       placeholder="Explore Materialize">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h5 class="breadcrumbs-title">Invoice</h5>
                        <ol class="breadcrumbs">
                            <li><a href="{{ route('get:manage_order') }}">Manage Order</a>
                            </li>
                            <li class="active">Invoice</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
            <div id="invoice">
                <div class="invoice-header">
                    <div class="row section">
                        <div class="col s12 m6 l6">
                            <img src="{{ asset('img/lozypay.png') }}" alt="company logo">
                            <p>To,
                                <br/>
                                <span class="strong">Jonathan Doe</span>
                                <br/>
                                <span>125, ABC Street,</span>
                                <br/>
                                <span>New Yourk, USA</span>
                                <br/>
                                <span>+91-(444)-(333)-(221)</span>
                            </p>
                        </div>

                        <div class="col s12 m6 l6">
                            <div class="invoce-company-address right-align">
                                <span class="invoice-icon"><i class="mdi-social-location-city cyan-text"></i></span>
                                <p><span class="strong">Company Name LLC</span>
                                    <br/>
                                    <span>125, ABC Street,</span>
                                    <br/>
                                    <span>New Yourk, USA</span>
                                    <br/>
                                    <span>+91-(444)-(333)-(221)</span>
                                </p>
                            </div>

                            {{--<div class="invoce-company-contact right-align">--}}
                            {{--<span class="invoice-icon"><i class="mdi-communication-quick-contacts-mail cyan-text"></i></span>--}}
                            {{--<p><span class="strong">www.exampledomain.com</span>--}}
                            {{--<br/>--}}
                            {{--<span>info@exampledomain.com</span>--}}
                            {{--<br/>--}}
                            {{--<span>admin@exampledomain.com</span>--}}
                            {{--</p>--}}
                            {{--</div>--}}

                        </div>
                    </div>
                </div>

                <div class="invoice-lable">
                    <div class="row">
                        <div class="col-sm-12  m9 invoice-brief cyan white-text">
                            <div class="row">
                                <div class="col s12 m3 l3">
                                    <h4 class="white-text invoice-text">INVOICE</h4>
                                </div>
                                <div class="col s12 m3 l3">
                                    <p class="strong">Total Due</p>
                                    <h4 class="header"><i
                                                class="fa fa-inr"></i> {{ $product->price * $product->quantity}}</h4>
                                </div>
                                <div class="col s12 m3 l3">
                                    <p class="strong">Invoice No</p>
                                    <h4 class="header">{{ $product->transaction_id }}</h4>
                                </div>
                                <div class="col s12 m3 l3">
                                    <p class="strong">Due Date</p>
                                    <h4 class="header">{{ \Carbon\Carbon::parse($product->careted_at)->format('d.m.Y') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="invoice-table">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <table class="striped">
                                <thead>
                                <tr>
                                    <th data-field="no">No</th>
                                    <th data-field="item">Item</th>
                                    <th data-field="uprice">Unit Price</th>
                                    <th data-field="price">Unit</th>
                                    <th data-field="price">Total</th>
                                    <th data-field="price">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>{{ $product->name }}</td>
                                    <td><i class="fa fa-inr"></i> {{ $product->price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td><i class="fa fa-inr"></i> {{ $product->price * $product->quantity}}</td>
                                    <td>
                                        <button class="btn @if($product->status == \App\Model\Order::PENDING) yellow darken-4 @elseif($product->status == \App\Model\Order::SUCCESS) green @elseif($product->status == \App\Model\Order::CANCELED) red darken-4 @elseif($product->status == \App\Model\Order::FAILED) btn-danger @elseif($product->status == \App\Model\Order::PROCESS) @else btn-floating yellow darken-1 @endif">{{ $product->status }}</button>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4"></td>
                                    <td>Sub Total:</td>
                                    <td><i class="fa fa-inr"></i> {{ $product->price * $product->quantity}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td>Service Tax</td>
                                    <td>11.00%</td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td class="cyan white-text">Grand Total</td>
                                    <td class="cyan strong white-text"><i
                                                class="fa fa-inr"></i> {{ $product->price * $product->quantity}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="invoice-footer">
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <p>Computer generated invoice</p>
                            <p class="strong">Terms & Condition</p>
                            <ul>
                                <li>You know, being a test pilot isn't always the healthiest business in the world.</li>
                                <li>We predict too much for the next year and yet far too little for the next 10.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('page-js')

    <script type="text/javascript">

    </script>
@endsection
