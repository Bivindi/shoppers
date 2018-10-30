@extends('admin.layout.default')
@section('title')
    @if(isset($brand))
        Edit Brands
    @else
        Add Brands
    @endif
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
                            @if(isset($brand))
                                Edit Brands
                            @else
                                Add Brands
                            @endif</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Brands</a>
                            </li>
                            <li class="active">@if(isset($brand))
                                    Edit Brands
                                @else
                                    Add Brands
                                @endif</li>
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
                        <h4 class="header2">@if(isset($brand))
                                Edit Brands
                            @else
                                Add Brands
                            @endif</h4>
                        <div class="row">
                            <form id="formValidate" class="col s12" action="{{ route('post:add_brand') }}"
                                  method="post" enctype="multipart/form-data">

                                {{ csrf_field() }}
                                @if(isset($brand))
                                    <input type="hidden" name="brandId" value="{{ $brand->id }}">
                                    <input type="hidden" name="oldBrandLogo" value="{{ $brand->brand_logo }}">
                                    <input type="hidden" name="oldBrandDoc" value="{{ $brand->brand_document }}">
                                @endif
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select name="category" id="category">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                @if(isset($brand))
                                                    {{ $selected = ($brand->category_id == $category->id) ? 'selected' : '' }}
                                                @endif
                                                <option value="{{ $category->id }}" @if(isset($brand)) {{ $selected }} @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="category">Select Category</label>
                                        <span class="error">{{ $errors->first('category') }}</span>
                                    </div>

                                    <div class="input-field col s12">
                                        <input id="name" name="name"
                                               value="{{ (isset($brand)) ? $brand->name : old('name') }}"
                                               type="text">
                                        <label for="name">Brand Name</label>
                                        <span class="error">{{ $errors->first('name') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <textarea id="desc"
                                                  class="materialize-textarea"
                                                  name="desc">{{ (isset($brand)) ? $brand->desc : old('desc') }}</textarea>
                                        <label for="desc">Description</label>
                                        <span class="error">{{ $errors->first('desc') }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12">
                                        <p>Brand Logo</p>
                                            @if(isset($brand))
                                                <input type="file" id="input-file-events" name="brand_logo" class="dropify-event"
                                                       data-default-file="{{ asset('brandsImg/100brands/'.$brand->brand_logo) }}"/>
                                            @else
                                                <input type="file" name="brand_logo" class="dropify"
                                                       data-default-file=""/>
                                            @endif
                                    </div>

                                    <div class="col s12">
                                        <p>Brand authorization document upload</p>
                                            <div class="row">
                                                @if(isset($brandDocs))
                                                    @if(count($brandDocs) != 0)                                                       
                                                        @foreach($brandDocs as $brandDoc)
                                                                <div class="col m4 s6 x6">
                                                                    @if($brandDoc->brands_documents)
                                                                        <?php $ext = pathinfo($brandDoc->brands_documents, PATHINFO_EXTENSION); ?>
                                                                        
                                                                        @if($ext=='pdf')
                                                                            <img src="{{ asset('brandsImg/documents/pdf_image.png') }}" height="100" width="100" alt="">
                                                                        @else
                                                                            <img src="{{ asset('brandsImg/documents/'.$brandDoc->brands_documents) }}" height="100" width="100" alt="">
                                                                        @endif

                                                                        <button class="btn btn-sm removeImg" brandDocId="{{ $brandDoc->id }}" style="display: block;">Remove</button>
                                                                    @endif
                                                                </div>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </div>  
                                    </div>

                                    <div class="col s12">
                                        <br><input type="file" name="brand_documents[]" class="" multiple/>  
                                    </div>


                                </div>

                                  
                           <!--  </form> -->
                                <div class="input-field col s12">
                                    <button class="btn cyan waves-effect waves-light submitBtn" type="submit">
                                        @if(isset($brand))
                                            Update
                                        @else
                                            Submit
                                        @endif
                                        <i class="mdi-content-send right"></i>
                                    </button>
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
        $("#formValidate").validate({
            rules: {
                name: 'required',
                desc: 'required',
            },
            //For custom messages
            messages: {
                name: "Please enter tax brand name..!",
                desc: "Please enter description..!",
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


        // $(document).ready(function () {
        //     // Basic
        //     $('.dropify').dropify();
        //     // Used events
        //     var drEvent = $('.dropify-event').dropify();

        //     drEvent.on('dropify.beforeClear', function (event, element) {
        //         var file = element.filename;
        //         swal({
        //                 title: "Are you sure?",
        //                 text: "You will not be able to recover this imaginary file!",
        //                 type: "warning",
        //                 showCancelButton: true,
        //                 confirmButtonClass: "btn-danger",
        //                 confirmButtonText: "Yes, delete it!",
        //                 cancelButtonText: "No, cancel plx!",
        //                 closeOnConfirm: false,
        //                 closeOnCancel: false
        //             },
        //             function (isConfirm) {
        //                 if (isConfirm) {
        //                     swal("Deleted!", "Your employee has been deleted.", "success");
        //                 } else {
        //                     swal("Cancelled", "Your employee is safe :)", "error");
        //                 }
        //             });
        //     });
        // });


        $(document).ready(function () {
            // Basic
            $('.dropify').dropify();
            // Used events
            var drEvent = $('.dropify-event').dropify();

            $(document).on('click', '.removeImg', function (e) {
                e.preventDefault();
                var brandDocId = $(this).attr('brandDocId');
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
                            url: '{{ route('get:delete_brand_document') }}',
                            data: {brandDocId: brandDocId},
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
