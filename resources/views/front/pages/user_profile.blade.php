@extends('front.layout.default')
@section('title')
    Profile
@endsection
@section('page-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
    <link rel="stylesheet" href="{{ asset('front/style.css') }}" />
    <style>
        .col-md-4 div strong {
            color: #696767;
        }

        .dataprof table#profile-table {
            display: inline-block;
        }

        .text-right-prof {
            text-align: right;
            border-right-style: solid;
            border-right-color: #fff;
            border-right-width: thick;
            margin-right: 10px;
        }

        .box-addres {
            box-shadow: 0px 2px 1px 1px #d0cece;
        }

        .addres-active {
            box-shadow: 0px 2px 1px 1px #FFA13B;
        }

        .step li {
            cursor: pointer;
        }

        .pro {
            display: inline-block;
            float: right;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .lable {
            color: #ffffff;
        }

        .authentication {
            border: 1px solid #eaeaea;
            padding: 30px;
            min-height: 320px;
        }

        .authentication > h3 {
            margin-bottom: 15px;
        }

        .authentication label {
            margin-top: 10px;
            margin-bottom: 2px;
        }

        .authentication .forgot-pass {
            margin-top: 15px;
        }

        .authentication .button:hover{
            border: none;
        }

        .authentication input,
        .authentication textarea,
        .authentication select {
            border-radius: 0px;
            border: 1px solid #eaeaea;
            -webkit-box-shadow: inherit;
            box-shadow: inherit;
        }

        .authentication .button {
            margin-top: 15px;
        }

        .authentication {
            border: 1px solid #eaeaea;
            padding: 30px;
            min-height: 320px;
        }

        .authentication{
            border-radius: 0px;
            border: 1px solid #eaeaea;
            -webkit-box-shadow: inherit;
            box-shadow: inherit
        }
        .page-order ul.step li
        {
        	/*width: 20%;*/
        	border-bottom: 3px solid #ccc;
        }
        .page-order ul.step li.current-step
        {
        	border-bottom: 3px solid #FFA13B;
        }
    </style>
@endsection

@section('body-class')
    class="category-page"
@endsection
@section('page-content')
	
	<section class="wishlist-slider-section  wd-slider-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h1 class="wishlist-slider-title">Profile</h1>
                        <div class="page-location pt-0">
                            <ul>
                                <li><a href="{{ url('') }}">
                                    Home <span class="divider">/</span>
                                </a></li>
                                <li><a class="page-location-active" href="#">
                                    <span class="active-color">Your Profile</span>
                                    <span class="divider">/</span>
                                </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="columns-container">
        <div class="container" id="columns">
            <!-- breadcrumb -->
            <!-- <div class="breadcrumb clearfix">
                <a class="home" href="#" title="Return to Home">Home</a>
                <span class="navigation-pipe">&nbsp;</span>
                <span class="navigation_page">Your Profile</span>
            </div> -->
            <!-- ./breadcrumb -->
            <!-- page heading-->
            <!-- <h2 class="page-heading no-line">
                <span class="page-heading-title2">Profile Details</span>
            </h2> -->
            <!-- ../page heading-->
            <div class="page-content page-order" style="min-height: 240px;">
                <ul class="step nav nav-pills nav-justified">
                    <li class="current-step active"><a class="changesec" id="1"><span>01. Personal Detail</span></a></li>
                    <li><a class="changesec" id="2"><span>02. Address</span></a></li>
                    <li><a class="changesec" id="3"><span>03. Change Paasword</span></a></li>
                </ul>
                <div class="row">
	                <div class="col-md-12 dataprof" style="padding: 1%;color: #908c8c;" id="sec1">
	                    <table id="profile-table">
	                        <tr>
	                            <td class="text-right-prof">Name</td>
	                            <td><strong>{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</strong></td>
	                        </tr>
	                        <tr>
	                            <td class="text-right-prof">Email ID</td>
	                            <td><strong>{{ Auth::user()->email }}</strong></td>
	                        </tr>
	                        <tr>
	                            <td class="text-right-prof">Mobile Number</td>
	                            <td><strong>{{ Auth::user()->mobile_num }}</strong></td>
	                        </tr>
	                        @if(Auth::user()->birth_date)
	                            <tr>
	                                <td class="text-right-prof">Date Of Birth</td>
	                                <td><strong>{{ Auth::user()->birth_date }}</strong></td>
	                            </tr>
	                        @endif
	                        @if(Auth::user()->state)
	                            <tr>
	                                <td class="text-right-prof">State</td>
	                                <td><strong>{{ Auth::user()->state }}</strong></td>
	                            </tr>
	                        @endif
	                        @if(Auth::user()->city)
	                            <tr>
	                                <td class="text-right-prof">City</td>
	                                <td><strong>{{ Auth::user()->city }}</strong></td>
	                            </tr>
	                        @endif
	                        @if(Auth::user()->gender)
	                            <tr>
	                                <td class="text-right-prof">Gender</td>
	                                <td><strong>{{ Auth::user()->gender }}</strong></td>
	                            </tr>
	                        @endif
	                        <tr>
	                            <td class="text-right-prof">KYC Status</td>
	                            <td><strong>@if(Auth::user()->kyc_status != 1)Not Apply @else Apply @endif</strong></td>
	                        </tr>
	                    </table>
	                    <a class="pro" id="editProfile">Edit Profile</a>
	                </div>
	            </div>
				<div class="row">
	                <div class="col-md-12 dataprof" style="padding: 1%;color: #908c8c;display: none;" id="sec2">
	                    @foreach($shippingAddress as $address)
	                        <div class="col-md-3 box-border box-addres @if($address->status == 1)  addres-active @endif"
	                             shippingId="{{ $address->id }}">
	                            <input class="slec-add hide" type="radio" name="address" @if($address->status == 1) checked
	                                   @endif value="1">
	                            {{ $address->address }}
	                        </div>
	                    @endforeach
	                </div>
	            </div>

	            <div class="row">
	                <div class="col-md-12 dataprof" style="padding: 1%;color: #908c8c;display: none;" id="sec3">
	                    <form>
	                        <div class="form-group row">
	                            <div class="col-xs-4 col-md-4">
	                                <input class="form-control" id="ex1" type="password" placeholder="Old Password">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <div class="col-xs-4 col-md-4">
	                                <input class="form-control" id="ex2" type="password" placeholder="New Password">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <div class="col-xs-4 col-md-4">
	                                <input class="form-control" id="ex3" type="password" placeholder="Confirm Password">
	                            </div>
	                        </div>
	                    </form>
	                </div>
				</div>	               
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script>
        $(function () {
            $('.box-addres').click(function () {
                if ($(this).hasClass('addres-active')) {

                }
                else {
                    $(this).addClass('addres-active');
                    $(this).siblings().removeClass('addres-active');
                    $(this).siblings().children().removeAttr('checked');
                    $(this).children().prop("checked", true);
                    var selectedValue = $("input[name='address']:checked").val();
                    var shippingId = $(this).attr('shippingId');
                    $.ajax({
                        type: 'get',
                        url: "{{ route('get:select_shipping_address') }}",
                        data: {shippingId: shippingId},
                        success: function (result) {
                            if (result.success == true) {
                                $.notify("Shipping address selected..!!", "success");
                            }
                            if (result.error == true) {
                                $.notify("Shipping address not selected something is wrong..!!", "error");
                            }
                        }
                    });

                }

            });

            $('.changesec').click(function () {
                var idd = $(this).attr('id');
                $('.current-step').removeClass('current-step');
                $(this).parent().addClass('current-step');
                $(".dataprof").hide();
                var data = "sec" + idd;
                $("#" + data).css('display', 'block');
            });
        });

        $(document).on('click', '#editProfile', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'get',
                url: "{{ route('get:user_profile_form') }}",
                beforeSend: function () {
                    $("#sec1").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                },
                success: function (result) {
                    $('#sec1').html(result);
                }
            });
        });
    </script>
@endsection