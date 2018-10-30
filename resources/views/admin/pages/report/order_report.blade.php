@extends('admin.layout.default')
@section('title')
    Order Report
@endsection
@section('page-css')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>
    <style>
        .daterangepicker.ltr {
            display: none;
        }

        .input-mini {
            -webkit-box-sizing: border-box !important;
            -moz-box-sizing: border-box !important;
            box-sizing: border-box !important;
        }
    </style>
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
                        <h5 class="breadcrumbs-title">Order Report</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Reports</a>
                            </li>
                            <li class="active">Order Report</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumbs end-->
        <!--start container-->
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="col m12">
                        <div class="col m4" style="margin-top: 10px;">
                            <a href="{{ route('get:order_export_file', 'xlsx') }}" class="btn green">Excel</a>
                            <a href="{{ route('get:order_export_file', 'csv') }}" class="btn green">CSV</a>
                            <a href="{{ route('get:order_export_file', 'pdf') }}" class="btn green">PDF</a>
                        </div>
                    </div>
                    <div class="col m4">
                        <input type="text" class="range" name="range" value="" placeholder="Select date range"/>
                    </div>
                    <div class="col m4">
                        <select name="seller" class="seller">
                            <option value="">Select Seller</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col m4">
                        <select name="status" class="status">
                            <option value="">Select Status</option>
                            <option value="{{ \App\Model\Order::SUCCESS }}">{{ \App\Model\Order::SUCCESS }}</option>
                            <option value="{{ \App\Model\Order::FAILED }}">{{ \App\Model\Order::FAILED }}</option>
                            <option value="{{ \App\Model\Order::PENDING }}">{{ \App\Model\Order::PENDING }}</option>
                            <option value="{{ \App\Model\Order::RETURNED }}">{{ \App\Model\Order::RETURNED }}</option>
                            <option value="{{ \App\Model\Order::PROCESS }}">{{ \App\Model\Order::PROCESS }}</option>
                            <option value="{{ \App\Model\Order::CANCELED }}">{{ \App\Model\Order::CANCELED }}</option>
                        </select>
                    </div>
                    <div class="table-responsive commission">
                        <table class="responsive-table">
                            <thead>
                            <tr>
                                <th data-field="id">Id</th>
                                <th data-field="name">Product Name</th>
                                <th data-field="id">Order Id</th>
                                <th data-field="id">Transaction Id</th>
                                <th data-field="name">Subcategory Name</th>
                                <th data-field="name">category Name</th>
                                <th data-field="date">Date</th>
                                <th data-field="status">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $key => $order)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->unique_order_id }}</td>
                                    <td>{{ $order->transaction_id }}</td>
                                    <td>{{ $order->subcategory }}</td>
                                    <td>{{ $order->category }}</td>
                                    <td>{{ Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</td>
                                    <td><button class="btn @if($order->status == \App\Model\Order::SUCCESS) green @elseif($order->status == \App\Model\Order::PENDING) yellow @else red @endif btn-md">
                                            {{ ucfirst($order->status) }}
                                        </button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $orders->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('page-js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script type="text/javascript">
        $(function () {
            $('.range').daterangepicker({
                autoUpdateInput: true,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('.range').on('change', function (ev, picker) {
                var daterange = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{{ route('get:order_filter') }}',
                    data: {daterange: daterange},
                    success: function (result) {
                        $('.commission').html(result)
                    }
                })
            });

        });


        $('.seller').on('change', function (ev, picker) {
            var seller = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ route('get:order_filter') }}',
                data: {seller: seller},
                success: function (result) {
                    $('.commission').html(result);
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            })
        });

        $('.status').on('change', function (ev, picker) {
            var status = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ route('get:order_filter') }}',
                data: {status: status},
                success: function (result) {
                    $('.commission').html(result);
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            })
        });

        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
