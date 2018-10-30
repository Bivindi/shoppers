@extends('admin.layout.default')
@section('title')
    Manage Seller Holiday
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

    <link href="{{ asset('assets/js/plugins/fullcalendar/css/fullcalendar.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <style>
        .text-center {
            text-align: center;
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
                        <h5 class="breadcrumbs-title">Manage Seller Holiday</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Seller</a>
                            </li>
                            <li class="active">Manage Seller Holiday</li>
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
                   <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Add Holiday</a>
                   <br>
              </div>
            </div>

            <div class="row">
                <div class="col s12 m12 l12">
                  <div id='calendar'></div>
              </div>
            </div>
        </div>
    </section>
   
       <div id="modal1" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Holiday</h4>
            </div>
            <div class="modal-body">
                <h4 class="header2">Add Holidays</h4>
                <div class="row">
                    <form class="col s12" id="holidays" method="post" action="manage_seller_holidays">
                        {{ csrf_field() }}
                        <input type="hidden" class="transId" name="transId" value="">
                       
                        <div class="input-field col s12">
                            <textarea id="remark" class="materialize-textarea" name="remark"></textarea>
                            <label for="message">Remark</label>
                        </div>
                        <div class="input-field col s12">
                            <input type="text" name="holiday_date" value="" placeholder="Holiday Date" class="form-control holiday_date"  />
                            <label for="message">Holiday Date</label>
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



<script type="text/javascript" src="{{ asset('assets/') }}/js/plugins/chartist-js/chartist.min.js"></script>  
<!-- <script type="text/javascript" src="{{ asset('assets/') }}/js/plugins/fullcalendar/lib/jquery-ui.custom.min.js"></script> -->
<script type="text/javascript" src="{{ asset('assets/') }}/js/plugins/fullcalendar/js/fullcalendar.min.js"></script>
<!-- <script type="text/javascript" src="{{ asset('assets/') }}/js/plugins/fullcalendar/fullcalendar-script.js"></script> -->

<script type="text/javascript">

$(document).ready(function() {

  $('.holiday_date').pickadate({
    labelMonthNext: 'Go to the next month',
    labelMonthPrev: 'Go to the previous month',
    labelMonthSelect: 'Pick a month from the dropdown',
    labelYearSelect: 'Pick a year from the dropdown',
    selectMonths: true,
    selectYears: true
})

$('#calendar').fullCalendar({
    events: function(start, end, timezone, callback) {
        $.ajax({
            url: '{{ route('get:get_seller_holidays') }}',
            dataType: 'json',
            success: function(doc) {
                var events = [];
                if(!!doc.result){
                    $.map( doc.result, function( r ) {
                        events.push({
                            title: r.title,
                            start: r.start,
                        });
                    });
                }
                callback(events);
            }
        });
    }
});


    
});









</script>
@endsection
