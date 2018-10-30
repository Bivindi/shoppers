@extends('admin.layout.default')
@section('title')
    Sales Report
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
                        <h5 class="breadcrumbs-title">Sales Report</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Reports</a>
                            </li>
                            <li class="active">Sales Report</li>
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
                    <div class="table-responsive commission">
                        <table class="responsive-table">
                            <thead>
                            <tr>
                                <th data-field="id">Id</th>
                                <th data-field="name">Seller Name</th>
                                <th data-field="price">Product</th>
                                <th data-field="id">Price</th>
                                <th data-field="id">Fee Deduction</th>
                            </tr>
                            </thead>
                            @if(count($salesReports)>0)
                            <tbody>
                            @foreach($salesReports as $key => $salesReport)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $salesReport->first_name }}</td>
                                    <td>{{ $salesReport->productname }}</td>
                                    <td>{{ $salesReport->price }}</td>
                                    <td><a class="waves-effect waves-light btn red modal-trigger feeBtn modalClick"
                                     productid="{{ $salesReport->productid }}" href="#feeModal">View</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                            @else
                                <tr class="text-center">
                                    <td>No Data Found</td>
                                </tr>
                             @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="feeModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Fee Deduction</h4>
            </div>
            <div class="modal-body">
            
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Cancel</a>
        </div>
    </div>
@endsection
@section('page-js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script type="text/javascript">
        
        
        $('.modalClick').on('click', function (ev, picker) {
            var productid = $(this).attr('productid');

            $.ajax({
                type: 'get',
                url: '{{ route('get:fee_deduct_data') }}',
                data: {productid: productid},
                success: function (result) {
                    $('.modal-body').html(result);
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
