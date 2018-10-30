@extends('admin.layout.default')
@section('title')
    Manage Return Orders
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
                        <h5 class="breadcrumbs-title">Manage Return Orders</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Orders</a>
                            </li>
                            <li class="active">Manage Return Orders</li>
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
                                <th>Size</th>
                                <th>Color</th>
                                <th>Reason</th>
                                <th>Comments</th>
                                <th>Status</th>
                                <th>Approve</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $key => $order)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-centers"><img
                                                src="{{ asset('100ProductImg/'.$order->product_img) }}"
                                                alt="" class="img-thumbnail" height="50" width="50"></td>
                                    <td class="name">{{ mb_strimwidth($order->name, 0, 25, '...') }}</td>
                                    <td class="name">{{ $order->username }}</td>
                                    <td class="name">{{ $order->price }}</td>
                                    <td class="name">{{ $order->size }}</td>
                                    <td class="name">{{ $order->color }}</td>
                                    <td class="name">{{ $order->reason }}</td>
                                    <td class="name">{{ $order->comments }}</td>
                                    <td class="text-left">
                                        <button class="btn @if($order->status == \App\Model\Order::SUCCESS) green @elseif($order->status == \App\Model\Order::PENDING) yellow darken-4 @elseif($order->status == \App\Model\Order::CANCELED) red darken-4 @elseif($order->status == \App\Model\Order::FAILED) btn-danger @elseif($order->status == \App\Model\Order::PROCESS) yellow @elseif($order->delivered_seller == 1) green
                                         @else yellow darken-1 @endif" >@if($order->delivered_seller == 1) Returned to seller @else {{ $order->status }} @endif</button>
                                    </td>
                                    <td class="text-left">
                                        <button class="btn @if($order->delivered_seller != 1) approve @endif @if($order->return_approve != 1) green  @else btn-danger @endif  @if($order->delivered_seller == 1) disabled @endif"
                                            transId="{{ $order->transaction_id }}">@if($order->return_approve == 1)
                                                Returned to seller @else Approve @endif</button>
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


        $(document).on('click', '.approve', function (e) {
            e.preventDefault();
            var $this = $(this);
            var transId = $this.attr('transId');
            $.ajax({
                type: 'get',
                url: '{{ route('get:order_return_approve') }}',
                data: {transId: transId},
                beforeSend: function () {
                    $this.html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                    $this.attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        location.reload();
                    } else {
                        $.notify(result.message, "error");
                        $this.html('Approve');
                        $this.attr('disabled', false);
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
