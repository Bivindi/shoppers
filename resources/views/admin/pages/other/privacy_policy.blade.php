@extends('admin.layout.default')
@section('title')
    Add Privacy Policy
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
                            Privacy Policy
                        </h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Homepage Pages</a>
                            </li>
                            <li class="active">Add Privacy Policy</li>
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
                        <h4 class="header2">Add Privacy Policy</h4>
                        <div class="row">
                            <form id="formValidate" class="col s12" action="{{ route('post:privacy_policy') }}"
                                  method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @if(count($policy)>0)
                                    <input type="hidden" name="privacyId" value="{{ $policy->id }}">
                                    <input type="hidden" name="oldAboutImg" value="{{ $policy->image }}">
                                @endif
                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea id="summernote" name="desc" rows="10"
                                                  cols="10">{!! (count($policy)>0) ? $policy->desc : old('desc') !!}</textarea>
                                        <span class="error">{{ $errors->first('desc') }}</span>
                                    </div>
                                    <div class="col s12">
                                        <p>Privacy Image</p>
                                        @if(count($policy)>0)
                                            <input type="file" id="input-file-events" name="privacy_image"
                                                   class="dropify-event"
                                                   data-default-file="{{ asset('otherpages/'.$policy->image) }}"/>
                                        @else
                                            <input type="file" name="privacy_image" class="dropify"
                                                   data-default-file=""/>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light submitBtn" type="submit">
                                            @if(count($policy)>0)
                                                Update
                                            @else
                                                Submit
                                            @endif
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
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "#summernote",
            height: "250",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });

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
    </script>
@endsection
