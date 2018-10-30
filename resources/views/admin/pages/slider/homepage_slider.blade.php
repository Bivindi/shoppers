@extends('admin.layout.default')
@section('title')
    Homepage Slider
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
                        <h5 class="breadcrumbs-title">
                            Homepage Slider
                        </h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Slider</a>
                            </li>
                            <li class="active">
                                Homepage Slider
                            </li>
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
                        <h4 class="header2">
                            Homepage Slider
                        </h4>
                        <div class="row">
                            @if(count($mainSliders) != 0)
                                @foreach($mainSliders as $mainSlider)
                                    <div class="col m4 s6 x6">
                                        @if($mainSlider->main_slider)
                                            <img src="{{ asset('slider/'.$mainSlider->main_slider) }}" height="100" width="100" alt="">
                                            <p>{{ $mainSlider->url }}</p>
                                            <button class="btn btn-sm removeImg" sliderId="{{ $mainSlider->id }}"
                                                    style="display: block;">Remove
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <form class="col s12 formValidate" action="{{ route('post:homepage_slider') }}"
                                  method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col s12">
                                        <p>Homepage Main Slider</p>
                                        <div class="input_fields_wrap">
                                            <div>
                                                <input type="file" name="main_slider">
                                                <input type="text" name="url" placeholder="Enter Url">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light submitBtn" type="submit">
                                            Submit
                                            <i class="mdi-content-send right"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card-panel">
                        <h4 class="header2">
                            Homepage Small Image
                        </h4>
                        <div class="row">
                            @if(count($smallSliders)>0)
                                @foreach($smallSliders as $smallSlider)
                                    <div class="col m3 s6 x6">
                                        @if($smallSlider->small_slider)
                                            <img src="{{ asset('slider/'.$smallSlider->small_slider) }}" height="100"
                                                 width="100" alt="">
                                            <p>{{ $smallSlider->url }}</p>
                                            <button class="btn btn-sm removeImg" sliderId="{{ $smallSlider->id }}"
                                                    style="display: block;">Remove
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <form id="smallSlider" class="col s12 formValidate" action="{{ route('post:homepage_slider') }}"
                                  method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col s12">
                                        <p>Homepage Small Slider</p>
                                        <input type="file" name="small_slider"/>
                                        <input type="text" name="url" placeholder="Enter Url">
                                        <span class="help-block block">Image save 220*169 dimension</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light submitBtn" type="submit">
                                            Submit
                                            <i class="mdi-content-send right"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card-panel">
                        <h4 class="header2">
                            Homepage Medium Image
                        </h4>
                        <div class="row">
                            @if(count($mediumSliders)>0)
                                @foreach($mediumSliders as $mediumSlider)
                                    <div class="col m3 s6 x6">
                                        @if($mediumSlider->medium_slider)
                                            <img src="{{ asset('slider/'.$mediumSlider->medium_slider) }}" height="100"
                                                 width="100" alt="">
                                            <p>{{ $mediumSlider->url }}</p>
                                            <button class="btn btn-sm removeImg" sliderId="{{ $mediumSlider->id }}"
                                                    style="display: block;">Remove
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <form id="smallSlider" class="col s12 formValidate" action="{{ route('post:homepage_slider') }}"
                                  method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col s12">
                                        <p>Homepage Medium Image</p>
                                        <input type="file" id="profile" name="medium_slider" />
                                        <input type="text" name="url" placeholder="Enter Url">
                                        <span class="help-block block">Image save 350*169 dimension</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light submitBtn" type="submit">
                                            Submit
                                            <i class="mdi-content-send right"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card-panel">
                        <h4 class="header2">
                            New Arrival Slider
                        </h4>
                        <div class="row">
                            @if(count($newArrivalSliders)>0)
                                @foreach($newArrivalSliders as $newArrivalSlider)
                                    <div class="col m3 s6 x6">
                                        @if($newArrivalSlider->new_arrival_slider)
                                            <img src="{{ asset('slider/'.$newArrivalSlider->new_arrival_slider) }}"
                                                 height="100"
                                                 width="100" alt="">
                                            <p>{{ $newArrivalSlider->url }}</p>
                                            <button class="btn btn-sm removeImg" sliderId="{{ $newArrivalSlider->id }}"
                                                    style="display: block;">Remove
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <form id="smallSlider" class="col s12 formValidate" action="{{ route('post:homepage_slider') }}"
                                  method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col s12">
                                        <p>Slider Image</p>
                                        <input type="file" id="profile" name="new_arrival_slider" />
                                        <input type="text" name="url" placeholder="Enter Url">
                                        <span class="help-block block">Image save 227*348 dimension</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light submitBtn" type="submit">
                                            Submit
                                            <i class="mdi-content-send right"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card-panel">
                        <h4 class="header2">
                            Top Seller Slider
                        </h4>
                        <div class="row">
                            @if(count($topSellerSliders)>0)
                                @foreach($topSellerSliders as $topSellerSlider)
                                    <div class="col m3 s6 x6">
                                        @if($topSellerSlider->top_seller_slider)
                                            <img src="{{ asset('slider/'.$topSellerSlider->top_seller_slider) }}"
                                                 height="100"
                                                 width="100" alt="">
                                            <p>{{ $topSellerSlider->url }}</p>
                                            <button class="btn btn-sm removeImg" sliderId="{{ $topSellerSlider->id }}"
                                                    style="display: block;">Remove
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <form id="smallSlider" class="col s12 formValidate" action="{{ route('post:homepage_slider') }}"
                                  method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col s12">
                                        <p>Slider Image</p>
                                        <input type="file" id="profile" name="top_seller_slider" />
                                        <input type="text" name="url" placeholder="Enter Url">s
                                        <span class="help-block block">Image save 227*348 dimension</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light submitBtn" type="submit">
                                            Submit
                                            <i class="mdi-content-send right"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card-panel">
                        <h4 class="header2">
                            Top Seller Horizontal Image
                        </h4>
                        <div class="row">
                            @if(count($topSellerHorizontalSliders)>0)
                                @foreach($topSellerHorizontalSliders as $topSellerHorizontalSlider)
                                    <div class="col m3 s6 x6">
                                        @if($topSellerHorizontalSlider->seller_horizontal_slider)
                                            <img src="{{ asset('slider/'.$topSellerHorizontalSlider->seller_horizontal_slider) }}"
                                                 height="100"
                                                 width="100" alt="">
                                            <p>{{ $topSellerHorizontalSlider->url }}</p>
                                            <button class="btn btn-sm removeImg"
                                                    sliderId="{{ $topSellerHorizontalSlider->id }}"
                                                    style="display: block;">Remove
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <form id="smallSlider" class="col s12 formValidate" action="{{ route('post:homepage_slider') }}"
                                  method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col s12">
                                        <p>Slider Image</p>
                                        <input type="file" id="profile" name="seller_horizontal_slider" />
                                        <input type="text" name="url" placeholder="Enter Url">
                                        <span class="help-block block">Image save 580*120 dimension</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light submitBtn" type="submit">
                                            Submit
                                            <i class="mdi-content-send right"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card-panel">
                        <h4 class="header2">
                            Special Product Slider
                        </h4>
                        <div class="row">
                            @if(count($specialSliders)>0)
                                @foreach($specialSliders as $specialSlider)
                                    <div class="col m3 s6 x6">
                                        @if($specialSlider->special_product_slider)
                                            <img src="{{ asset('slider/'.$specialSlider->special_product_slider) }}"
                                                 height="100"
                                                 width="100" alt="">
                                            <p>{{ $specialSlider->url }}</p>
                                            <button class="btn btn-sm removeImg" sliderId="{{ $specialSlider->id }}"
                                                    style="display: block;">Remove
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <form id="smallSlider" class="col s12 formValidate" action="{{ route('post:homepage_slider') }}"
                                  method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col s12">
                                        <p>Slider Image</p>
                                        <input type="file" id="profile" name="special_product_slider" />
                                        <input type="text" name="url" placeholder="Enter Url">
                                        <span class="help-block block">Image save 227*348 dimension</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light submitBtn" type="submit">
                                            Submit
                                            <i class="mdi-content-send right"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card-panel">
                        <h4 class="header2">
                            Recommend Slider
                        </h4>
                        <div class="row">
                            @if(count($recommendSliders)>0)
                                @foreach($recommendSliders as $recommendSlider)
                                    <div class="col m3 s6 x6">
                                        @if($recommendSlider->recommend_slider)
                                            <img src="{{ asset('slider/'.$recommendSlider->recommend_slider) }}"
                                                 height="100"
                                                 width="100" alt="">
                                            <p>{{ $recommendSlider->url }}</p>
                                            <button class="btn btn-sm removeImg" sliderId="{{ $recommendSlider->id }}"
                                                    style="display: block;">Remove
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <form id="smallSlider" class="col s12 formValidate" action="{{ route('post:homepage_slider') }}"
                                  method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col s12">
                                        <p>Slider Image</p>
                                        <input type="file" id="profile" name="recommend_slider" />
                                        <input type="text" name="url" placeholder="Enter Url">
                                        <span class="help-block block">Image save 227*348 dimension</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light submitBtn" type="submit">
                                            Submit
                                            <i class="mdi-content-send right"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card-panel">
                        <h4 class="header2">
                            Footer Image
                        </h4>
                        <div class="row">
                            @if(count($footerImages)>0)
                                @foreach($footerImages as $footerImage)
                                    <div class="col m3 s6 x6">
                                        @if($footerImage->footer_slider)
                                            <img src="{{ asset('slider/'.$footerImage->footer_slider) }}"
                                                 height="100"
                                                 width="100" alt="">
                                            <button class="btn btn-sm removeImg" sliderId="{{ $footerImage->id }}"
                                                    style="display: block;">Remove
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <form id="footerForm" class="col s12" action="{{ route('post:homepage_slider') }}"
                                  method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col s12">
                                        <p>Footer Image</p>
                                        <input type="file" id="profile" name="footer_slider"/>
                                        <span class="help-block block">Image save 1920*1000 dimension</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light submitBtn" type="submit">
                                            Submit
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

            $(document).on('click', '.removeImg', function (e) {
                e.preventDefault();
                var sliderId = $(this).attr('sliderId');
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this image!",
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
                            url: '{{ route('get:delete_slider') }}',
                            data: {sliderId: sliderId},
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
        });
    </script>
@endsection
