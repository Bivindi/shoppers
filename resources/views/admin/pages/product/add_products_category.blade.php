@extends('admin.layout.default')
@section('title')
    Select category
@endsection
@section('page-css')
    <link rel="stylesheet" href="{{ asset('css/jquery.minicolors.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <!--dropify-->
    <link href="{{ asset('assets/js/plugins/dropify/css/dropify.min.css') }}" type="text/css" rel="stylesheet"
          media="screen,projection">
    <style>
        .removeScreenshots {
            position: absolute;
            left: 137px;
            top: 30px;
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
                        <h5 class="breadcrumbs-title">Products</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Products</a>
                            </li>
                            <li class="active">Categories</li>
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

          @foreach($mycategories as $category)
              <div class="col s12 m6 l3" >
                  <div class="card">
                      <div class="card-image">
                        <a href="{{ url('admin/add-products-select-subcategory',[$category->slug]) }}">
                        <img src="{{ asset('category/'.$category['thumb_img']) }}"
                                     alt="{{ $category['thumb_img'] }}" height="200px">
                        </a>
                        <!-- <span class="card-title">{{ $category['name'] }}</span> -->
                      </div>
                     <!--  <div class="card-content">
                        <p></p>
                      </div> -->
                      <div class="card-action">
                        <a href="{{ url('admin/add-products-select-subcategory',[$category->slug]) }}">{{ substr($category->name, 0, 20) }}</a>
                      </div>
                    </div>
                  </div>
                  @endforeach
            </div>
        </div>
    </section>
@endsection
@section('page-js')
    <script src="{{ asset('js/jquery.minicolors.min.js') }}"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({
            selector: "#summernote",
            height : "250",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });</script>
    <script language="JavaScript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"
            type="text/javascript"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.min.js') }}"></script>
@endsection