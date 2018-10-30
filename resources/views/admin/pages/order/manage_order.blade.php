@extends('admin.layout.default')
@section('title')
    Manage Orders
@endsection
@section('page-css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="{{ asset('assets/') }}/js/plugins/prism/prism.css" type="text/css" rel="stylesheet"
          media="screen,projection">
    <link href="{{ asset('assets/') }}/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css"
          rel="stylesheet" media="screen,projection">
    <link href="{{ asset('assets/') }}/js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet"
          media="screen,projection">
    <style>
        .img-thumbnail {
            padding: 4px;
            line-height: 1.42857;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 3px;
            -webkit-transition: all 0.2s ease-in-out;
            -o-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
            display: inline-block;
            max-width: 100%;
            height: auto;
        }
    </style>
@endsection

@section('page-content')
    <section id="content">
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
            <!-- Search for small screen -->
            <div class="header-search-wrapper grey hide-on-large-only">
                <i class="mdi-action-search active"></i>
                <input type="text" name="Search" class="header-search-input z-depth-2"
                       placeholder="Explore Materialize">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h5 class="breadcrumbs-title">Manage Orders</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Orders</a>
                            </li>
                            <li class="active">Manage Orders</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumbs end-->
        <!--start container-->
        <div class="container">
            <!--Form Advance-->
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="table-responsive">
                        <table id="example" class="display responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Customer</th>
                                <th>Price</th>
                                <th>Tax Amount</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Shipping</th>
                                <th>Status</th>
                                
                                <th>Invoice</th>
                                <th>Shipping Status</th>
                                <th>Shipping Invoice</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $key => $order)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-centers"><img
                                                src="{{ asset('100ProductImg/'.$order->product_img) }}"
                                                alt="" class="img-thumbnail" height="50" width="50"></td>
                                    <td class="name"><a href="{{ route('get:edit_products',['id' => $order->slug]) }}" target="_blank">{{ mb_strimwidth($order->name, 0, 25, '...') }}</a></td>
                                    <td class="name">{{ $order->username }}</td>
                                    <td class="name"><i class="fa fa-inr" aria-hidden="true"></i> {{ $order->price }}</td>
                                    <td class="name"><i class="fa fa-inr" aria-hidden="true"></i> 0 </td>
                                    <td class="name">{{ $order->size }}</td>
                                    <td class="name"><i class="mdi-image-color-lens" style="color:{{ $order->color }};font-size: 40px;"></i></td>
                                    <td>
                                        @if($order->status == \App\Model\Order::PROCESS)
                                            <a class="waves-effect waves-light btn modal-trigger shippingBtn  @if($order->shipping == \App\Model\Order::DISPATCH) light-blue @elseif($order->shipping == \App\Model\Order::NEARBYYOU) indigo @elseif($order->shipping == \App\Model\Order::ONTHEWAY) green accent-3 @else pink @endif"
                                               transId="{{ $order->transaction_id }}"
                                               orderDate="{{ Carbon\Carbon::parse($order->created_at)->format('Y,m,d') }}"
                                               href="#modal1">Shipping</a>
                                        @endif
                                    </td>
                                    <td class="text-left">
                                        <button class="btn @if($order->status == \App\Model\Order::SUCCESS) green @elseif($order->status == \App\Model\Order::PENDING) yellow darken-4 @elseif($order->status == \App\Model\Order::CANCELED) red darken-4 @elseif($order->status == \App\Model\Order::FAILED) btn-danger @elseif($order->status == \App\Model\Order::PROCESS) @else yellow darken-1 @endif">{{ $order->status }}</button>
                                    </td>
                                    <td>
                                        <a href="{{ route('get:product_invoice', $order->slug) }}" target="_blank"
                                           class="btn green">Invoice</a>
                                    </td>
                                    <td class="text-left">
                                        <button class="btn @if($order->status == \App\Model\Order::SUCCESS) green @elseif($order->status == \App\Model\Order::PENDING) yellow darken-4 @elseif($order->status == \App\Model\Order::CANCELED) red darken-4 @elseif($order->status == \App\Model\Order::FAILED) btn-danger @elseif($order->status == \App\Model\Order::PROCESS) @else yellow darken-1 @endif">{{ $order->status }}</button>
                                    </td>
                                    <td>
                                        <a href="{{ route('get:product_invoice', $order->slug) }}" target="_blank"
                                           class="btn green">Invoice</a>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{ route('post:order_status') }}" method="post">
                                                <input type="hidden" name="orderId" value="{{ $order->id }}">
                                                {{ csrf_field() }}
                                                <select name="status" class="browser-default"
                                                        style="margin-bottom: 10px;">
                                                    <option value="" disabled="" selected="">Choose Status
                                                    </option>
                                                    {{ $selected = ($order->status == \App\Model\Order::SUCCESS) ? 'selected' : ''}}
                                                    <option value="{{ \App\Model\Order::SUCCESS }}"
                                                            {{ $selected }}>
                                                        SUCCESS
                                                    </option>
                                                    {{ $selected = ($order->status == \App\Model\Order::FAILED) ? 'selected' : ''}}
                                                    <option value="{{ \App\Model\Order::FAILED }}" {{ $selected }}>
                                                        FAILED
                                                    </option>
                                                    {{ $selected = ($order->status == \App\Model\Order::CANCELED) ? 'selected' : ''}}
                                                    <option value="{{ \App\Model\Order::CANCELED }}" {{ $selected }}>
                                                        CANCELED
                                                    </option>
                                                    {{ $selected = ($order->status == \App\Model\Order::PENDING) ? 'selected' : ''}}
                                                    <option value="{{ \App\Model\Order::PENDING }}" {{ $selected }}>
                                                        PENDING
                                                    </option>
                                                    {{ $selected = ($order->status == \App\Model\Order::PROCESS) ? 'selected' : ''}}
                                                    <option value="{{ \App\Model\Order::PROCESS }}" {{ $selected }}>
                                                        PROCESS
                                                    </option>
                                                    {{ $selected = ($order->status == \App\Model\Order::RETURNED) ? 'selected' : ''}}
                                                    <option value="{{ \App\Model\Order::RETURNED }}" {{ $selected }}>
                                                        RETURNED
                                                    </option>
                                                </select>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-warning green">
                                                        Update
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="modal1" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Shipping Form</h4>
            </div>
            <div class="modal-body">
                <h4 class="header2">Order shipping update</h4>
                <div class="row">
                    <form class="col s12" id="ShippingProcess">
                        {{ csrf_field() }}
                        <input type="hidden" class="transId" name="transId" value="">
                        <div class="input-field col s12">
                            <select name="status">
                                <option value="{{ \App\Model\Order::DISPATCH }}">Dispatch</option>
                                <option value="{{ \App\Model\Order::ONTHEWAY }}">On The Way</option>
                                <option value="{{ \App\Model\Order::NEARBYYOU }}">Near By You</option>
                                <option value="{{ \App\Model\Order::DELIVERED }}">Delivered</option>
                            </select>
                            <label for="first_name" class="">Status</label>
                        </div>
                        <div class="input-field col s12">
                            <textarea id="message" class="materialize-textarea" name="remark"></textarea>
                            <label for="message">Remark</label>
                        </div>
                        <div class="input-field col s12">
                            <input type="text" name="delivery_date" value="" placeholder="Delivery Date"
                                   class="form-control delivery_date"/>
                            <label for="message">Delivery Date</label>
                        </div>
                        <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light right submitButn" type="submit"
                                    name="action">
                                Submit
                                <i class="mdi-content-send right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Cancel</a>
        </div>
    </div>
@endsection
@section('page-js')
    <script language="JavaScript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"
            type="text/javascript"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript"
            src="//cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#example').DataTable();
        });

        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $(document).on('click', '.shippingBtn', function () {
            var transId = $(this).attr('transId');
            var orderDate = $(this).attr('orderDate');
            $('.transId').val(transId);
            pickdate();
        });

        function pickdate(orderDate) {
            $('.delivery_date').pickadate({
                labelMonthNext: 'Go to the next month',
                labelMonthPrev: 'Go to the previous month',
                labelMonthSelect: 'Pick a month from the dropdown',
                labelYearSelect: 'Pick a year from the dropdown',
                selectMonths: true,
                selectYears: true
            })
        }

        $(document).on('submit', '#ShippingProcess', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'get',
                url: '{{ route('post:order_shipping_process') }}',
                data: $(this).serialize(),
                beforeSend: function () {
                    $('.submitButn').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                    $('.submitButn').attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        location.reload();
                    } else {
                        $.notify(result.message, "error");
                        $('.submitButn').html('Submit');
                        $('.submitButn').attr('disabled', false);
                    }
                }
            })
        });


        $(document).on('click', '.deletePerm', function (e) {
            e.preventDefault();
            var slug = $(this).attr('slug');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this order!",
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: 'get',
                        url: '{{ route('get:delete_permission') }}',
                        data: {slug: slug},
                        success: function (result) {
                            if (result.success == true) {
                                location.reload();
                            } else {
                                $.notify(result.message, "error");
                            }
                        }
                    })
                }
            });
        });
    </script>
@endsection
