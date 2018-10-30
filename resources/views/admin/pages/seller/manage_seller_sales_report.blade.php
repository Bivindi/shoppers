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
                        <select name="seller" class="seller">
                            <option value="" disabled="">Select Seller</option>
                            <option value="{{ Auth::user()->id }}">{{ Auth::user()->first_name }}</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                    </div>
                
                    <div class="table-responsive feeDeduction">
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
                            <tbody>
                            @foreach($salesReports as $key => $salesReport)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $salesReport->first_name }}</td>
                                    <td>{{ $salesReport->productname }}</td>
                                    <td>{{ $salesReport->price }}</td>
                                    <!-- modal-trigger -->
                                    <td><a class="waves-effect waves-light btn red  feeBtn modalClick"
                                     productid="{{ $salesReport->productid }}"  onclick="myFunction( $(this).attr('productid'))" href="#paymentModal" >View</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Fee Deduction</h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Close</a>
        </div>
    </div>
@endsection
@section('page-js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script type="text/javascript">

        $(document).on('click', '.feeBtn', function () {
        var paymentId = $(this).attr('sPaymentID');
        var paymentType = $(this).attr('pType');
        
        $('.sellerPaymentId').val(paymentId);
         $('.paymentType').val(paymentType);
        });

        
        $('.seller').on('change', function (ev, picker) {
            var seller = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ route('get:filter_seller_sales_report') }}',
                data: {seller: seller},
                success: function (result) {
                    $('.feeDeduction').html(result);
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            })
        });


        function myFunction(productid) {
            // var productid = $(this).attr('productid');

            $.ajax({
                type: 'get',
                url: '{{ route('get:fee_deduct_data') }}',
                data: {productid: productid},
                success: function (result) {
                     // $('.modal-trigger').leanModal();

                       $('#paymentModal').openModal();
                    $('.modal-body').html(result);
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            })
        }

        

        // $('.modalClick').on('click', function (ev, picker) {
        //     var productid = $(this).attr('productid');

        //     $.ajax({
        //         type: 'get',
        //         url: '{{ route('get:fee_deduct_data') }}',
        //         data: {productid: productid},
        //         success: function (result) {
        //             $('.modal-body').html(result);
        //             if (result.error == true) {
        //                 $.notify(result.message, "error");
        //             }
        //         }
        //     })


        // });



        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
