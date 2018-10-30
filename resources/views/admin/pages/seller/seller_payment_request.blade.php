@extends('admin.layout.default')
@section('title')
    Manage Seller
@endsection
@section('page-css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">

    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="{{ asset('assets/') }}/js/plugins/prism/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{ asset('assets/') }}/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{ asset('assets/') }}/js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <style>

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
                        <h5 class="breadcrumbs-title">Seller Payment Request</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Seller</a>
                            </li>
                            <li class="active">Seller Payment Request</li>
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
                    <form id="formValidate" class="col s12" action="{{ route('post:add_payment_request') }}" method="post" ">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="input-field col s12">        
                                <p>Your Wall Amount Is : {{Auth::user()->wallet_amount}}</p><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="amount" name="amount"  value="{{ old('amount') }}" type="number">
                                <label for="amount">Request amount</label>
                                <span class="error amount">{{ $errors->first('amount') }}</span>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <button class="btn cyan waves-effect waves-light submitBtn" type="submit">Submit
                                <i class="mdi-content-send right"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
@endsection
@section('page-js')
    <script language="JavaScript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"
            type="text/javascript"></script>
  
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script type="text/javascript">
        $("#formValidate").validate({
            rules: {
                amount: {
                    required: true,
                    number: true
                }
            },
            //For custom messages
            messages: {
                amount: "Please enter your request amount..!",
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
        
    </script>
@endsection
