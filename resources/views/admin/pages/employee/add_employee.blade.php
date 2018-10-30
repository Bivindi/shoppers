@extends('admin.layout.default')
@section('title')
    Add Employee
@endsection
@section('page-css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <!--dropify-->
    <link href="{{ asset('assets/js/plugins/dropify/css/dropify.min.css') }}" type="text/css" rel="stylesheet"
          media="screen,projection">
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
                        <h5 class="breadcrumbs-title">Add Employee</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Employee</a>
                            </li>
                            <li class="active">Add Employee</li>
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
                    <div class="card-panel">
                        <h4 class="header2">Add Employee</h4>
                        <div class="row">
                            <form id="formValidate" class="col s12" action="{{ route('post:add_employee') }}"
                                  method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @if(isset($user))
                                    <input type="hidden" name="userId" value="{{ $user->id }}">
                                    <input type="hidden" name="oldProfile" value="{{ $user->profile }}">
                                @endif
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input id="first_name" name="first_name"
                                               value="{{ (isset($user)) ? $user->first_name : old('first_name') }}"
                                               type="text">
                                        <label for="first_name">First Name</label>
                                        <span class="error">{{ $errors->first('first_name') }}</span>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="last_name" name="last_name"
                                               value="{{ (isset($user)) ? $user->last_name : old('last_name') }}"
                                               type="text">
                                        <label for="last_name">Last Name</label>
                                        <span class="error">{{ $errors->first('last_name') }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input id="username" name="username"
                                               value="{{ (isset($user)) ? $user->username : old('username') }}"
                                               type="text">
                                        <label for="username">Username</label>
                                        <span class="error">{{ $errors->first('username') }}</span>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="mobile_number" name="mobile_number"
                                               value="{{ (isset($user)) ? $user->mobile_num : old('mobile_number') }}"
                                               type="number">
                                        <label for="mobile_number">Mobile Number</label>
                                        <span class="error">{{ $errors->first('mobile_number') }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input id="email" name="email"
                                               value="{{ (isset($user)) ? $user->email : old('email') }}" type="email">
                                        <label for="email">Email</label>
                                        <span class="error">{{ $errors->first('email') }}</span>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="password" name="password" type="password">
                                        <label for="password">Password</label>
                                        <span class="error">{{ $errors->first('password') }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <select name="state" id="state">
                                            <option value="">Select States</option>
                                            @foreach($states as $state)
                                                @if(isset($user))
                                                    {{ $selected = ($user->state == $state->name) ? 'selected' : '' }}
                                                @endif
                                                <option value="{{ $state->code }}" @if(isset($user)) {{ $selected }} @endif>{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="state">State</label>
                                        <span class="error">{{ $errors->first('state') }}</span>
                                    </div>
                                    <div class="input-field col s6">
                                        <select name="city" id="city">
                                            <option value="">Select City</option>
                                            @foreach($cities as $city)
                                                @if(isset($user))
                                                    {{ $selected = ($city->city == $city->name) ? 'selected' : '' }}
                                                @endif
                                                <option value="{{ $city->id }}" @if(isset($user)) {{ $selected }} @endif>{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="city">City</label>
                                        <span class="error">{{ $errors->first('city') }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s6 6">
                                        <p>Status</p>
                                        <p>
                                            <input name="status" value="active"
                                                   @if(isset($user)) {{ ($user->status == 1) ? 'checked' : ''}} @endif type="radio"
                                                   id="test1"/>
                                            <label for="test1">Active</label>
                                            <input name="status" value="inactive"
                                                   @if(isset($user)) {{ ($user->status == 0) ? 'checked' : ''}} @endif type="radio"
                                                   id="test2"/>
                                            <label for="test2">Inactive</label>
                                        </p>
                                    </div>
                                </div>
                                <div class="row section">
                                    <div class="col s12 6">
                                        <p>Profile</p>
                                        @if(isset($user))
                                            <input type="file" id="input-file-events" class="dropify-event"
                                                   data-default-file="{{ asset('profile/'.$user->profile) }}"/>
                                        @else
                                            <input type="file" id="profile" name="profile" class="dropify"
                                                   data-default-file=""/>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light submitBtn" type="submit">Submit
                                            <i class="mdi-content-send right"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
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
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            // Basic
            $('.dropify').dropify();
            // Used events
            var drEvent = $('.dropify-event').dropify();

            drEvent.on('dropify.beforeClear', function (event, element) {
                var file = element.filename;
                swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel plx!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            swal("Deleted!", "Your employee has been deleted.", "success");
                        } else {
                            swal("Cancelled", "Your employee is safe :)", "error");
                        }
                    });
            });
        });


        $("#formValidate").validate({
            rules: {
                first_name: 'required',
                last_name: 'required',
                username: 'required',
                email: {
                    required: true,
                    email: true
                },
                password: 'required',
                mobile_number: {
                    required: true,
                    minlength: 9,
                    maxlength: 10,
                    number: true
                },
            },
            //For custom messages
            messages: {
                first_name: "Please enter your username..!",
                last_name: "Please enter your username..!",
                username: "Please enter your username..!",
                email: "Please enter your email..!",
                password: "Please enter your password..!",
                mobile_number: "Enter your mobile number..!",
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
