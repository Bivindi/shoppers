@extends('admin.layout.default')
@section('title')
    Seller Commission Report
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
                        <h5 class="breadcrumbs-title">Seller Commission Report</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Reports</a>
                            </li>
                            <li class="active">Seller Commission Report</li>
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
                        <a href="{{ route('get:seller_commission_export_file', 'xlsx') }}" class="btn green">Excel</a>
                        <a href="{{ route('get:seller_commission_export_file', 'csv') }}" class="btn green">CSV</a>
                        <a href="{{ route('get:seller_commission_export_file', 'pdf') }}" class="btn green">PDF</a>
                    </div>
                    <div class="table-responsive commission">
                        <table class="responsive-table">
                            <thead>
                            <tr>
                                <th data-field="id">Id</th>
                                <th data-field="id">Seller Name</th>
                                <th data-field="name">Commission</th>
                                <th data-field="price">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($commissions as $key => $commission)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $commission->username }}</td>
                                    <td>@if($commission->isAdmin()) {{ $commission->getCommissionByOrderId() }} @else
                                            0 @endif</td>
                                    <td>{{ Carbon\Carbon::parse($commission->created_at)->format('d-m-Y') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $commissions->links() !!}
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
                    url: '{{ route('get:commission_filter_order') }}',
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
                url: '{{ route('get:commission_filter_order') }}',
                data: {seller: seller},
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
