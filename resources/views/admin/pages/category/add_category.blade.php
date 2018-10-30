@extends('admin.layout.default')
@section('title')
    @if(isset($category))
        Edit Category
    @else
        Add Category
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
                            @if(isset($category))
                                Edit Category
                            @else
                                Add Category
                            @endif</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Category</a>
                            </li>
                            <li class="active">@if(isset($category))
                                    Edit Category
                                @else
                                    Add Category
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
                        <h4 class="header2">@if(isset($category))
                                Edit Category
                            @else
                                Add Category
                            @endif</h4>
                        <div class="row">
                            <form id="formValidate" class="col s12" action="{{ route('post:add_category') }}"
                                  method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @if(isset($category))
                                    <input type="hidden" name="categoryId" value="{{ $category->id }}">
                                    <input type="hidden" name="oldCatImg" value="{{ $category->cat_img }}">
                                    <input type="hidden" name="oldThumImg" value="{{ $category->thumb_img }}">
                                    <input type="hidden" name="oldOtherImg" value="{{ $category->other_image }}">
                                    <input type="hidden" name="oldSideImg" value="{{ $category->sidebar_image }}">
                                @endif
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="name" name="name"
                                               value="{{ (isset($category)) ? $category->name : old('name') }}"
                                               type="text">
                                        <label for="name">Name</label>
                                        <span class="error">{{ $errors->first('name') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                    <textarea id="desc" class="materialize-textarea"
                                              name="desc">{{ (isset($category)) ? $category->desc : old('desc') }}</textarea>
                                        <label for="desc">Description</label>
                                        <span class="error">{{ $errors->first('desc') }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="metaTitle" name="m_title"
                                               value="{{ (isset($category)) ? $category->m_title : old('m_title') }}"
                                               type="text">
                                        <label for="metaTitle">Meta Title</label>
                                        <span class="error">{{ $errors->first('m_title') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="metaKeywords" name="m_keywords"
                                               value="{{ (isset($category)) ? $category->m_keywords : old('m_keywords') }}"
                                               type="text">
                                        <label for="metaKeywords">Meta Keywords</label>
                                        <span class="error">{{ $errors->first('m_keywords') }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="mTags" name="m_tag"
                                               value="{{ (isset($category)) ? $category->desc : old('m_tag') }}"
                                               type="text">
                                        <label for="mTags">Meta Tags</label>
                                        <span class="error">{{ $errors->first('m_tag') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <textarea id="mDesc"
                                                  class="materialize-textarea"
                                                  name="m_desc">{{ (isset($category)) ? $category->m_desc : old('m_desc') }}</textarea>
                                        <label for="mDesc">Description</label>
                                        <span class="error">{{ $errors->first('m_desc') }}</span>
                                    </div>
                                </div>

                                <div class="row">
                                <p>&nbsp;&nbsp;Total Fee Deduction</p>
                                <div class="input-field col s6">
                                    <input id="deduction_charge" name="deduction_charge"
                                               value="{{ (isset($category)) ? $category->deduction_charge : old('deduction_charge') }}"
                                               type="number">
                                        <label for="deduction_charge">Fee Deduction Charge</label>
                                        <span class="error">{{ $errors->first('deduction_charge') }}</span>
                                </div>

                                <div class="input-field col s6">
                                    <select name="deduction_type" id="deduction_type">
                                        <option value="">Select Deduction Type</option>
                                        <option value="{{ \App\Model\Categories::PERCENTAGE }}" 
                                        @if(isset($category)) {{ ($category->deduction_type == \App\Model\Categories::PERCENTAGE) ? 'selected' : '' }} 
                                        @endif> {{ \App\Model\Categories::PERCENTAGE }}</option>

                                        <option value="{{ \App\Model\Categories::FLAT }}" @if(isset($category)) {{ ($category->deduction_type == \App\Model\Categories::FLAT) ? 'selected' : '' }} @endif>{{ \App\Model\Categories::FLAT }}</option>

                                    </select>
                                   <!--  <label for="deduction_type">Select Deduction Type</label> -->
                                    <span class="error">{{ $errors->first('deduction_type') }}</span>
                                </div>
                            </div>
                             
                            <div class="row">
                                <p>&nbsp;&nbsp;Payment Collection Fee</p>
                                <div class="input-field col s6">
                                    <input id="selling_fee" name="selling_fee"
                                        value="{{ (isset($category)) ? $category->selling_fee : old('selling_fee') }}"
                                        type="number">
                                    <label for="selling_fee">Selling Fee</label>
                                    <span class="error">{{ $errors->first('selling_fee') }}</span>
                                </div>

                                <div class="input-field col s6">
                                    <input id="closing_fee" name="closing_fee"
                                        value="{{ (isset($category)) ? $category->closing_fee : old('closing_fee') }}"
                                        type="number">
                                    <label for="closing_fee">Closing Fee</label>
                                    <span class="error">{{ $errors->first('deduction_charge') }}</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s6">
                                    <input id="total_fee" name="total_fee"
                                        value="{{ (isset($category)) ? $category->total_fee : old('total_fee') }}"
                                        type="number">
                                    <label for="total_fee">Total Fee</label>
                                    <span class="error">{{ $errors->first('total_fee') }}</span>
                                </div>

                                <div class="input-field col s6">
                                    <input id="service_tax" name="service_tax"
                                        value="{{ (isset($category)) ? $category->service_tax : old('service_tax') }}"
                                        type="number">
                                    <label for="service_tax">Service Tax</label>
                                    <span class="error">{{ $errors->first('service_tax') }}</span>
                                </div>
                            </div>


                                <div class="row">
                                    <div class="col s12">
                                        <p>Thumb Image</p>
                                        @if(isset($category))
                                            <input type="file" id="input-file-events" name="thumb_img" class="dropify-event"
                                                   data-default-file="{{ asset('category/'.$category->thumb_img) }}"/>
                                        @else
                                            <input type="file" name="thumb_img" class="dropify"
                                                   data-default-file=""/>
                                        @endif
                                    </div>
                                </div>

                                  <div class="row">
                                    <div class="col s12">
                                        <p>Category Image</p>
                                        @if(isset($category))
                                            <input type="file" id="input-file-events" name="cat_img" class="dropify-event"
                                                   data-default-file="{{ asset('category/'.$category->cat_img) }}"/>
                                        @else
                                            <input type="file" name="cat_img" class="dropify"
                                                   data-default-file=""/>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col s12">
                                        <p>NavMenu Image</p>
                                        @if(isset($category))
                                            <input type="file" id="input-file-events" name="other_image" class="dropify-event"
                                                   data-default-file="{{ asset('category/'.$category->other_image) }}"/>
                                        @else
                                            <input type="file"  name="other_image" class="dropify"
                                                   data-default-file=""/>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12">
                                        <p>Sidebar Image</p>
                                        @if(isset($category))
                                            <input type="file" id="input-file-events" name="sidebar_image" class="dropify-event"
                                                   data-default-file="{{ asset('699CategoryImg/'.$category->sidebar_image) }}"/>
                                        @else
                                            <input type="file"  name="sidebar_image" class="dropify"
                                                   data-default-file=""/>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light submitBtn" type="submit">
                                            @if(isset($category))
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
    <script type="text/javascript" src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
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
                name: 'required',
            },
            //For custom messages
            messages: {
                name: "Please enter category name..!",
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
