@extends('admin.layout.default')
@section('title')
    Profile
@endsection
@section('page-css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('assets/js/plugins/dropify/css/dropify.min.css') }}" type="text/css" rel="stylesheet"
          media="screen,projection">
    <style>
        .text-center {
            text-align: center;
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
                        <h5 class="breadcrumbs-title">Profile</h5>
                        <ol class="breadcrumbs"></ol>
                    </div>
                </div>
            </div>
        </div>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container">
            <div id="basic-form" class="section">
                <div class="row">
                    <div class="col m12">
                        <div class="card-panel">
                            <h4 class="header2">Profile Details</h4> 
                            <div class="row">
                                <form class="col s12" action="{{ route('post:profile') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input placeholder="Company Name"
                                                   value="{{ Auth::user()->company_name }}" name="company_name"
                                                   type="text">
                                            <label for="company_name" class="active">Company Name</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input placeholder="John Doe" value="{{ Auth::user()->first_name }}"
                                                   name="first_name" type="text">
                                            <label for="first_name" class="active">First Name</label>
                                            <span class="error">{{ $errors->first('first_name') }}</span>
                                        </div>
                                        <div class="input-field col s6">
                                            <input placeholder="John Doe" value="{{ Auth::user()->last_name }}"
                                                   name="last_name" type="text">
                                            <label for="first_name" class="active">Last Name</label>
                                            <span class="error">{{ $errors->first('last_name') }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input placeholder="John Doe" value="{{ Auth::user()->username }}" disabled
                                                   type="text">
                                            <label for="first_name" class="active">Username</label>
                                            <span class="error">{{ $errors->first('username') }}</span>
                                        </div>
                                        <div class="input-field col s6">
                                            <input placeholder="john@domainname.com" value="{{ Auth::user()->email }}"
                                                   type="email" disabled>
                                            <label for="email" class="active">Email</label>
                                            <span class="error">{{ $errors->first('email') }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input placeholder="9929844542" disabled
                                                   value="{{ Auth::user()->mobile_num }}" type="number">
                                            <label for="first_name" class="active">Mobile Number</label>
                                            <span class="error">{{ $errors->first('mobile_num') }}</span>
                                        </div>
                                        <div class="input-field col s6">
                                            <input placeholder="16-digit" value="{{ Auth::user()->aadhar_num }}"
                                                   name="aadhar_num" type="text">
                                            <label for="first_name" class="active">Aadhar Number</label>
                                            <span class="error">{{ $errors->first('aadhar_num') }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input placeholder="Enter your pan or tan number"
                                                   value="{{ Auth::user()->pan_or_tan_num }}" name="pan_tan_number"
                                                   type="text">
                                            <label for="first_name" class="active">Pan or Tan number</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input placeholder="Enter gst number" value="{{ Auth::user()->gst_num }}"
                                                   name="gst_number" type="text">
                                            <label for="first_name" class="active">GST Number</label>
                                        </div>
                                    </div>
                                </div> <!-- row over -->
                            </div> <!-- Card panel over -->

                            <div class="card-panel">
                                <h4 class="header2">Address Details</h4> 
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="Shipping Address"
                                                value="{{ Auth::user()->shipping_address }}" name="shipping_address"
                                                type="text">
                                        <label for="shipping_address" class="active">Shipping Address</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="Pincode" value="{{ Auth::user()->pincode }}"
                                                name="pincode" type="number">
                                        <label for="pincode" class="active">Pincode</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="City"
                                                value="{{ Auth::user()->city }}" name="city"
                                                type="text">
                                        <label for="city" class="active">City</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="State" value="{{ Auth::user()->state }}"
                                                name="state" type="text">
                                        <label for="state" class="active">State</label>
                                    </div>
                                </div>
                            </div> <!-- Card panel over -->

                            <div class="card-panel">
                                <h4 class="header2">Seller code Details</h4> 
                                <div class="row">
                                    <div class="input-field col s4">
                                        <input placeholder="Beneficiary Name"
                                                value="{{ Auth::user()->benificiary_name }}" name="seller_name"
                                                type="text">
                                        <label for="seller_name" class="active">Seller name and code</label>
                                    </div>

                                    <div class="input-field col s4">
                                        <select name="fullfilment_mode">
                                            <option value="seller">Seller</option>
                                            <option value="Shoppers beam">Shoppers beam</option>
                                        </select>
                                        <label for="fullfilment_mode" class="active">Fullfilment mode</label>

                                    </div>
                                    <div class="input-field col s4">
                                        <input placeholder="Fullfilment mode"
                                                value="{{ Auth::user()->location }}" name="location"
                                                type="text">
                                        <label for="location" class="active">Location</label>
                                    </div>
                                </div>
                            </div> <!-- Card panel over -->

                            <div class="card-panel">
                                <h4 class="header2">Holiday</h4>
                                <div class="row">
                                    <div class="col s3">
                                        <div id="lnb">
                                            <div class="lnb-new-schedule">
                                                <button data-target="modal1" id="btn-new-schedule" type="button" class="btn btn-default btn-block modal-trigger" data-toggle="modal">New holliday</button>
                                            </div>
                                            <div id="lnb-calendars" class="lnb-calendars">
                                                <div>
                                                    <div class="lnb-calendars-item">
                                                        <label>
                                                            <input class="tui-full-calendar-checkbox-square" type="checkbox" value="all" checked="">
                                                            <span></span>
                                                            <strong>View all</strong>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div id="calendarList" class="lnb-calendars-d1">
                                                    <div class="lnb-calendars-item">
                                                        <label>
                                                            <input type="checkbox" class="tui-full-calendar-checkbox-round" value="1" checked="">
                                                            <span style="border-color: #9e5fff; background-color: #9e5fff;"></span>
                                                            <span>Other holliday</span>
                                                        </label>
                                                    </div>
                                                    <div class="lnb-calendars-item">
                                                        <label>
                                                            <input type="checkbox" class="tui-full-calendar-checkbox-round" value="8" checked="">
                                                            <span style="border-color: #ff4040; background-color: #ff4040;"></span>
                                                            <span>National Holidays</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="calendarList" class="lnb-calendars-d1"></div>
                                    <div class="col s9">
                                        <div id="menu">
                                            <span id="menu-navi">
                                                <button type="button" class="btn btn-default btn-sm move-day" data-action="move-today">Today</button>
                                                <button type="button" class="btn btn-default btn-sm move-day" data-action="move-prev">
                                                    <i class="material-icons" data-action="move-prev">chevron_left</i>
                                                </button>
                                                <button type="button" class="btn btn-default btn-sm move-day" data-action="move-next">
                                                    <i class="material-icons" data-action="move-next">chevron_right</i>
                                                </button>
                                            </span>
                                            <span id="renderRange" class="render-range">2018.11.11 ~  11.17</span>
                                        </div>
                                        <div id="calendar" style="height: 500px;"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Structure -->
                            <div id="modal1" class="modal modal-fixed-footer">
                                <div class="modal-content">
                                    <h4>Holliday details</h4>
                                    <p>The informations entered in fields below are relative to the holliday informations</p>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input placeholder="Title" name="remarks" type="text">
                                            <label for="remarks" class="active">Holliday title</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input placeholder="Start date" name="starts" type="date">
                                            <label for="starts" class="active">Beginning date</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input placeholder="End date" name="ends" type="date">
                                            <label for="ends" class="active">Ending date</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <select name="type">
                                                <option value="other_holliday"><span style="border-color: #9e5fff; background-color: #9e5fff;"></span> Other holliday</option>
                                                <option value="national_holliday"><span style="border-color: #ff4040; background-color: #ff4040;"></span> National holliday</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="modal-close waves-effect waves-green btn-flat">Cancel</button>
                                    <button class="waves-effect waves-green btn-flat add-holliday">Save</button>
                                </div>
                            </div>
                            
                            <div class="card-panel">
                                <h4 class="header2">Bank Details</h4> 
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input placeholder="Beneficiary Name"
                                                   value="{{ Auth::user()->benificiary_name }}" name="benificiary_name"
                                                   type="text">
                                            <label for="benificiary_name" class="active">Beneficiary Name</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input placeholder="Account Number" value="{{ Auth::user()->account_number }}" name="account_number" type="number">
                                            <label for="account_number" class="active">Account Number</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input placeholder="IFSC Code"
                                                   value="{{ Auth::user()->ifsc_code }}" name="ifsc_code"
                                                   type="number">
                                            <label for="ifsc_code" class="active">IFSC Code</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input placeholder="Bank Name" value="{{ Auth::user()->bank_name }}" name="bank_name" type="text">
                                            <label for="bank_name" class="active">Bank Name</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input placeholder="Branch Name"
                                                   value="{{ Auth::user()->branch_name }}" name="branch_name"
                                                   type="text">
                                            <label for="branch_name" class="active">Branch Name</label>
                                        </div>
                                    </div>
                            </div> <!-- Card panel over -->

                            <div class="card-panel">
                                    <h4 class="header2">Shipping Details</h4> 
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <!-- <p>Shipping Type</p> -->
                                            <input name="shipping_type" value="0" type="radio" id="test1" {{ (Auth::user()->shipping_type == 0) ? 'checked' : ''}} />
                                            <label for="test1">Shopper Beem</label>
                                            <input name="shipping_type" value="1" type="radio" id="test2" {{ (Auth::user()->shipping_type == 1) ? 'checked' : ''}} />
                                            <label for="test2">Own Shipping</label>
                                            
                                            
                                            <span class="error">{{ $errors->first('status') }}</span>
                                        </div>
                                    </div>
                                </div> <!-- Card panel over -->
                                   
                            <div class="card-panel">
                                <h4 class="header2">Documents Uploads</h4> 
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <span class="active" style="display: block;">Kyc Documents</span>
                                            @if(count($kycDocs)>0)
                                                @foreach($kycDocs as $doc)
                                                    <div class="col s3">
                                                        <a href="{{ asset('aadharcard/'.$doc->kyc_doc) }}" target="_blank"><img src="{{ asset('aadharcard/'.$doc->kyc_doc) }}" height="100"
                                                             width="100" title="Kyc Documents"></a>
                                                        <button class="btn green removeDoc" kycDoc="{{ $doc->kyc_doc }}" style="display: block;">Remove</button>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="input-field col s12">
                                            <input type="file" id="profile" name="kyc_docs[]"
                                                   multiple/>
                                        </div>
                                   <!--  </div>
                                    <div class="row"> -->
                                        <div class="input-field col s12">
                                            <span class="active" style="display: block;">Other Documents</span>
                                            @if(count($otherDocs)>0)
                                                @foreach($otherDocs as $doc)
                                                    <div class="col s3">
                                                        <a href="{{ asset('aadharcard/'.$doc->other_doc) }}" target="_blank"><img src="{{ asset('aadharcard/'.$doc->other_doc) }}"
                                                             height="100"
                                                             width="100" title="Other Documents"> </a>
                                                        <button class="btn green removeOtherDoc" kycDoc="{{ $doc->other_doc }}" style="display: block;">Remove</button>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="input-field col s12">
                                            <input type="file" id="profile" name="other_docs[]"
                                                   multiple/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button class="btn cyan waves-effect waves-light right" type="submit"
                                                    name="action">Submit
                                                <i class="mdi-content-send right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- row over -->
                        </div> <!-- Card panel over -->



                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('page-js')
    <script language="JavaScript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"
            type="text/javascript"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.dropify').dropify();
            var drEvent = $('.dropify-event').dropify();
        });

        $(document).on('click', '.removeDoc', function (e) {
            e.preventDefault();
            var kycDoc = $(this).attr('kycDoc');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this employee!",
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
                        url: '{{ route('get:delete_kyc_doc') }}',
                        data: {kycDoc: kycDoc},
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
        $(document).on('click', '.removeOtherDoc', function (e) {
            e.preventDefault();
            var kycDoc = $(this).attr('kycDoc');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this employee!",
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
                        url: '{{ route('get:delete_other_doc') }}',
                        data: {kycDoc: kycDoc},
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

        $(document).on('submit', '#holliday-form', function (e) {
            e.preventDefault();
            console.log($(".add-holliday").closest("form").serialise());
        })

        var Calendar = tui.Calendar

        var c = new Calendar('#calendar', {
            defaultView: 'month',
            taskView: ['milestone', 'task'],
            scheduleView: true,
            template: {
                milestone: function(schedule) {
                    return '<span style="color:red;"><i class="fa fa-flag"></i> ' + schedule.title + '</span>';
                },
                milestoneTitle: function() {
                    return 'Milestone';
                },
                task: function(schedule) {
                    return '&nbsp;&nbsp;#' + schedule.title;
                },
                taskTitle: function() {
                    return '<label><input type="checkbox" />Task</label>';
                },
                allday: function(schedule) {
                    return schedule.title + ' <i class="fa fa-refresh"></i>';
                },
                alldayTitle: function() {
                    return 'All Day';
                },
                time: function(schedule) {
                    return schedule.title + ' <i class="fa fa-refresh"></i>' + schedule.start;
                }
            },
            week: {
                daynames: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                startDayOfWeek: 0,
                narrowWeekend: true
            },
            month: {
                daynames: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                startDayOfWeek: 0,
                narrowWeekend: true
            },
        });

        $(".move-day").click(function(){
            let action = $(this).attr("data-action")
            switch(action){
                case 'move-next' :  c.next();
                                    break;
                case 'move-prev' :  c.prev();
                                    break;
                case 'move-today':  c.today();
                                    break;
                default: return;
            }
        });

        c.createSchedules([
            @foreach($hollidays as $h)
            <?php $dates = explode(",", $h->holiday_dates); ?>
                {
                    id: {{ $h->id }},
                    calendarId: c.id,
                    title: '{{ $h->remarks }}',
                    category: 'time',
                    dueDateClass: '',
                    start: new Date("{{ $dates[0] }}"),
                    end: new Date("{{ $dates[count($dates)-1] }}")
                },
            @endforeach
        ]);
    </script>
@endsection