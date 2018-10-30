@extends('admin.layout.default')
@section('title')
    Recharge Report
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
                        <h5 class="breadcrumbs-title">Recharge Report</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Reports</a>
                            </li>
                            <li class="active">Recharge Report</li>
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
                            <a href="{{ route('get:recharge_export_file', 'xlsx') }}" class="btn green">Excel</a>
                            <a href="{{ route('get:recharge_export_file', 'csv') }}" class="btn green">CSV</a>
                            <a href="{{ route('get:recharge_export_file', 'pdf') }}" class="btn green">PDF</a>
                        </div>
                    </div>
                    <div class="col m4">
                        <input type="text" class="range" name="range" value="" placeholder="Select date range"/>
                    </div>
                    <div class="col m4">
                        <select name="operator" class="operator">
                            <option value="all">All</option>
                            @foreach($operators as $operator)
                                <option value="{{ $operator->id }}">{{ $operator->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col m4">
                        <select name="status" class="status">
                            <option value="all">All</option>
                            <option value="{{ \App\Model\RechargeHistory::SUCCESS }}">SUCCESS</option>
                            <option value="{{ \App\Model\RechargeHistory::FAILED }}">FAILED</option>
                            <option value="{{ \App\Model\RechargeHistory::PENDING }}">PENDING</option>
                        </select>
                    </div>
                    <div class="table-responsive commission">
                        <table class="responsive-table">
                            <thead>
                            <tr>
                                <th data-field="id">Id</th>
                                <th data-field="name">Mobile Number</th>
                                <th data-field="id">Operator Name</th>
                                <th data-field="id">Circle Name</th>
                                <th data-field="name">Amount</th>
                                <th data-field="name">Username</th>
                                <th data-field="date">Date</th>
                                <th data-field="status">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recharges as $key => $recharge)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $recharge->recharge_num }}</td>
                                    <td>{{ $recharge->op_name }}</td>
                                    <td>{{ $recharge->circle }}</td>
                                    <td>{{ $recharge->amount }}</td>
                                    <td>{{ $recharge->username }}</td>
                                    <td>{{ Carbon\Carbon::parse($recharge->created_at)->format('d-m-Y') }}</td>
                                    <td>
                                        <button class="btn @if($recharge->status == \App\Model\RechargeHistory::SUCCESS) green @elseif($recharge->status == \App\Model\RechargeHistory::PENDING) yellow @else red @endif btn-md">
                                            {{ ucfirst($recharge->status) }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $recharges->links() !!}
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
                    url: '{{ route('get:recharge_filter') }}',
                    data: {daterange: daterange},
                    success: function (result) {
                        $('.commission').html(result)
                    }
                })
            });

        });


        $('.operator').on('change', function (ev, picker) {
            var operator = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ route('get:recharge_filter') }}',
                data: {operator: operator},
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
                url: '{{ route('get:recharge_filter') }}',
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
