@extends('admin.layout.default')
@section('title')
    View Payment Requets
@endsection
@section('page-css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css"
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
                        <h5 class="breadcrumbs-title">Payment requests</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Payment</a>
                            </li>
                            <li class="active">Payment requests</li>
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
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Request Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sellerPayments as $key => $payment)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-left">@if($payment->payment_status == 0) Pending @elseif($payment->payment_status == 1) Aproved @elseif($payment->payment_status == 2) Decline
                                    @elseif($payment->payment_status == 3) Withdrawn @endif</td>
                                    <td class="text-left">{{ $payment->amount }}</td>
                                    <td class="text-left">{{ $payment->created_at }}</td>
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
    </script>
@endsection