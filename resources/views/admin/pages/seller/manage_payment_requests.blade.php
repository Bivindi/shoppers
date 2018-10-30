@extends('admin.layout.default')
@section('title')
    Manage Payment Requets
@endsection
@section('page-css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">

    <style type="text/css">
        .not-active {
          pointer-events: none;
          cursor: default;
          text-decoration: none;
          color: black;
         
        }
        .grey
        {
            background-color: #DFDFDF !important;
            box-shadow: none;
            color: #9F9F9F !important;
            cursor: default;
        }
        .btn{
             padding: 0 .5rem
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
                        <h5 class="breadcrumbs-title">Manage Payment requests</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Payment</a>
                            </li>
                            <li class="active">Manage Payment requests</li>
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
                                <th>Update Status</th>
                                <th>Action</th>
                                <th>Seller Name</th>
                                <th>Request Amount</th>
                                <th>Wallet Amount</th>
                                <th>Request Date</th>
                                <th>Remarks</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paymentRequests as $key => $payment)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-left">
                                        <button class="btn @if($payment->payment_status == 0) yellow darken-1 
                                            @elseif($payment->payment_status == 1) green
                                            @elseif($payment->payment_status == 2) red
                                            @elseif($payment->payment_status == 3) btn @endif">@if($payment->payment_status == 0 ) Pending @elseif($payment->payment_status == 1) Approved @elseif($payment->payment_status == 2) Decline @elseif($payment->payment_status == 3) Withdrawn @endif</button>
                                    </td>
                                    <td>
                                        <button class="btn green" id="approveButton" transId="{{ $payment->id }}" @if( $payment->payment_status==1 || $payment->payment_status==2 || $payment->payment_status==3) disabled @endif >Approve</button>

                                        <a class="waves-effect waves-light btn red modal-trigger declineBtn @if($payment->payment_status==2 || $payment->payment_status==3) not-active grey @endif " sPaymentID ="{{ $payment->id }}" pType="decline" href="#paymentModal"  >Decline</a>
                                    </td>
                                    <td class="text-left">
                                        @if($payment->payment_status == 1)
                                            <a class="waves-effect waves-light btn green modal-trigger withdrawBtn"
                                               sPaymentID ="{{ $payment->id }}" pType="withdraw" href="#paymentModal">Withdraw</a>
                                        @endif
                                    </td>
                                    <td class="text-left">{{ ucfirst($payment->first_name) }}</td>
                                     <td class="text-left">{{ $payment->amount }}</td>
                                    <td class="text-left">{{ $payment->wallet_amount }}</td>
                                   
                                    <td class="text-left">{{ $payment->created_at }}</td>
                                    <td class="text-left">{{ $payment->remarks }}</td>

                                    
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
                <h4 class="modal-title">Remark Form</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="formValidate" class="col s12" id="paymentProcess" method="post" action="{{ route('post:update_seller_payment_remark') }}">
                        {{ csrf_field() }}
                        <input type="hidden" class="sellerPaymentId" name="sellerPaymentId" value="">
                        <input type="hidden" class="paymentType" name="paymentType" value="">
                        <div class="input-field col s12">
                            <textarea id="remark" class="materialize-textarea" name="remark">{{old('remark')}}</textarea>
                            <label for="remark">Remark</label>
                            <span class="error remark">{{ $errors->first('remark') }}</span>
                        </div>
                        
                        <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light right submitButn" type="submit" > Submit <i class="mdi-content-send right"></i></button>
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
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script type="text/javascript">

    $(document).ready(function () {
        $('#example').DataTable();
    });

    $(document).on('click', '#approveButton', function () {
        var id = $(this).attr('transId');
        if (id) {
                $.ajax({
               
                type: 'post',
                url: '{{ route('post:update_seller_payment_status') }}',
                data: {sPaymentId: id, status:'1',_token: '{{csrf_token()}}'},
                dataType: "json",
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
        
    $(document).on('click', '.withdrawBtn', function () {
        var paymentId = $(this).attr('sPaymentID');
        var paymentType = $(this).attr('pType');
        
        $('.sellerPaymentId').val(paymentId);
         $('.paymentType').val(paymentType);
    });

     $(document).on('click', '.declineBtn', function () {
        var paymentId = $(this).attr('sPaymentID');
        var paymentType = $(this).attr('pType');
        
        $('.sellerPaymentId').val(paymentId);
         $('.paymentType').val(paymentType);
    });

    // $(document).on('click', '#withdraw', function (e) {
    //         e.preventDefault();
    //         var id = $(this).attr('sPaymentID');
    //         if (id) {
    //             $.ajax({
    //             type: 'get',
    //             url: '',
    //             data: {slug: slug},
    //             success: function (result) {
    //                 if (result.success == true) {
    //                     location.reload();
    //                 } else {
    //                 $.notify(result.message, "error");
    //                 }
    //             }
    //         })
    //     }
    // });
    </script>
@endsection