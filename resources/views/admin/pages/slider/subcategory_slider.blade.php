@extends('admin.layout.default')
@section('title')
    Subcategory Slider
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
                            Subcategory Slider
                        </h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Slider</a>
                            </li>
                            <li class="active">
                                Subcategory Slider
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
                            Subcategory Slider
                        </h4>
                        <div class="row">
                            @if(count($mainSliders) != 0)
                                @foreach($mainSliders as $mainSlider)
                                    <div class="col m3 s6 x6">
                                        @if($mainSlider->main_slider)
                                            <img src="{{ asset('slider/'.$mainSlider->main_slider) }}" height="100"
                                                 width="100" alt="">
                                            <button class="btn btn-sm removeImg" sliderId="{{ $mainSlider->id }}"
                                                    style="display: block;">Remove
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <form id="formValidate" class="col s12" action="{{ route('post:subcategory_slider') }}"
                                  method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col s12">
                                        <p>Homepage Main Slider</p>
                                        <input type="file" id="profile" name="main_slider[]" multiple/>
                                        <span class="help-block">Image upload 871*288 dimension</span>
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
                            Sidebar Slider
                        </h4>
                        <div class="row">
                            @if(count($sidebarSliders)>0)
                                @foreach($sidebarSliders as $sidebarSlider)
                                    <div class="col m3 s6 x6">
                                        @if($sidebarSlider->sidebar_slider)
                                            <img src="{{ asset('slider/'.$sidebarSlider->sidebar_slider) }}" height="100"
                                                 width="100" alt="">
                                            <button class="btn btn-sm removeImg" sliderId="{{ $sidebarSlider->id }}"
                                                    style="display: block;">Remove
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <form id="smallSlider" class="col s12" action="{{ route('post:subcategory_slider') }}"
                                  method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col s12">
                                        <p>Homepage Small Slider</p>
                                        <input type="file" id="profile" name="sidebar_slider[]" multiple/>
                                        <span class="help-block block">Image save 271*346 dimension</span>
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
                            url: '{{ route('get:delete_sub_slider') }}',
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


        $("#formValidate").validate({
            rules: {
                "main_slider[]": "required"
            },
            //For custom messages
            messages: {
                "main_slider[]": "Please select slider image..!",
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
