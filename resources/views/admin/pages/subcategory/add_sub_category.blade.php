@extends('admin.layout.default')
@section('title')
    @if(isset($subcategory))
        Edit SubCategory
    @else
        Add SubCategory
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
                            @if(isset($subcategory))
                                Edit SubCategory
                            @else
                                Add SubCategory
                            @endif</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Category</a>
                            </li>
                            <li class="active">@if(isset($subcategory))
                                    Edit SubCategory
                                @else
                                    Add SubCategory
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
                        <h4 class="header2">@if(isset($subcategory))
                                Edit SubCategory
                            @else
                                Add SubCategory
                            @endif</h4>
                        <div class="row">
                            <form id="formValidate" class="col s12" action="{{ route('post:add_subcategory') }}"
                                  method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @if(isset($subcategory))
                                    <input type="hidden" name="subcategoryId" value="{{ $subcategory->id }}">
                                    <input type="hidden" name="oldSubCatImg" value="{{ $subcategory->sub_cat_img }}">
                                      <input type="hidden" name="oldThumbImg" value="{{ $subcategory->thumb_img }}">
                                @endif
                                <div class="row">

                                    <div class="input-field col s12">
                                        <select name="category" id="category">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                @if(isset($subcategory))
                                                    {{ $selected = ($subcategory->category_id == $category->id) ? 'selected' : '' }}
                                                @endif
                                                <option value="{{ $category->id }}" @if(isset($subcategory)) {{ $selected }} @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="category">Select Category</label>
                                        <span class="error">{{ $errors->first('category') }}</span>
                                    </div>
                                    
                                    <div class="input-field col s12">
                                        <input id="name" name="name"
                                               value="{{ (isset($subcategory)) ? $subcategory->name : old('name') }}"
                                               type="text">
                                        <label for="name">Name</label>
                                        <span class="error">{{ $errors->first('name') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                    <textarea id="desc" class="materialize-textarea"
                                              name="desc">{{ (isset($subcategory)) ? $subcategory->desc : old('desc') }}</textarea>
                                        <label for="desc">Description</label>
                                        <span class="error">{{ $errors->first('desc') }}</span>
                                    </div>
                                    
                                    <div class="input-field col s12">
                                        <input id="name" name="commission"
                                               value="{{ (isset($subcategory)) ? $subcategory->commission : old('commission') }}"
                                               type="number">
                                        <label for="name">Commission</label>
                                        <span class="error">{{ $errors->first('commission') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <select name="commission_type" id="commissionType">
                                            <option value="">Select Commission Type</option>
                                            @if(isset($subcategory))
                                            {{ $selected = ($subcategory->commission_type == \App\Model\SubCategory::PERCENTAGE) ? 'selected' : '' }}
                                            @endif
                                            <option value="{{ \App\Model\SubCategory::PERCENTAGE }}" @if(isset($subcategory)) {{ $selected }} @endif>{{ \App\Model\SubCategory::PERCENTAGE }}</option>
                                            @if(isset($subcategory))
                                                {{ $selected = ($subcategory->commission_type == \App\Model\SubCategory::FLAT) ? 'selected' : '' }}
                                            @endif
                                            <option value="{{ \App\Model\SubCategory::FLAT }}" @if(isset($subcategory)) {{ $selected }} @endif>{{ \App\Model\SubCategory::FLAT }}</option>
                                        </select>
                                        <label for="commissionType">Select Commission Type</label>
                                        <span class="error">{{ $errors->first('commission_type') }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="metaTitle" name="m_title"
                                               value="{{ (isset($subcategory)) ? $subcategory->m_title : old('m_title') }}"
                                               type="text">
                                        <label for="metaTitle">Meta Title</label>
                                        <span class="error">{{ $errors->first('m_title') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="metaKeywords" name="m_keywords"
                                               value="{{ (isset($subcategory)) ? $subcategory->m_keywords : old('m_keywords') }}"
                                               type="text">
                                        <label for="metaKeywords">Meta Keywords</label>
                                        <span class="error">{{ $errors->first('m_keywords') }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="mTags" name="m_tag"
                                               value="{{ (isset($subcategory)) ? $subcategory->desc : old('m_tag') }}"
                                               type="text">
                                        <label for="mTags">Meta Tags</label>
                                        <span class="error">{{ $errors->first('m_tag') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <textarea id="mDesc"
                                                  class="materialize-textarea"
                                                  name="m_desc">{{ (isset($subcategory)) ? $subcategory->m_desc : old('m_desc') }}</textarea>
                                        <label for="mDesc">Description</label>
                                        <span class="error">{{ $errors->first('m_desc') }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12">
                                        <p>Category Image</p>
                                        @if(isset($subcategory))
                                            <input type="file" id="input-file-events" name="sub_cat_img"
                                                   class="dropify-event"
                                                   data-default-file="{{ asset('subcategory/'.$subcategory->sub_cat_img) }}"/>
                                        @else
                                            <input type="file" id="profile" name="sub_cat_img" class="dropify"
                                                   data-default-file=""/>
                                        @endif
                                    </div>
                                </div>

                                 <div class="row">
                                    <div class="col s12">
                                        <p>Category Thumb Image</p>
                                        @if(isset($subcategory))
                                            <input type="file" id="input-file-events" name="thumb_img"
                                                   class="dropify-event"
                                                   data-default-file="{{ asset('subcategory/'.$subcategory->thumb_img) }}"/>
                                        @else
                                            <input type="file" id="profile" name="thumb_img" class="dropify"
                                                   data-default-file=""/>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light submitBtn" type="submit">
                                            @if(isset($subcategory))
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
                name: 'required',
                category: 'required',
            },
            //For custom messages
            messages: {
                name: "Please enter subcategory name..!",
                category: "Please select category..!",
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
