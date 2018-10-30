@extends('admin.layout.default')
@section('title')
    Menu Category
@endsection
@section('page-css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <style>
        .mb5 {
            margin-bottom: 5px;
        }
    </style>
@endsection
@section('page-content')
    <section id="content">
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
                            Menu Category
                        </h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);"> Top Menu Category</a>
                            </li>
                            <li class="active">Menu Category</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--start container-->
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card-panel">
                        <h4 class="header2">Select Category</h4>
                        <div class="row">
                            <form id="formValidate" class="col s12" action="{{ route('post:add_menu_category') }}" method="post">
                                {{ csrf_field() }}
                                @foreach($category as $key => $cat)
                                    <div class="form-field col s3 mb5">
                                        <input name="category[]" class="category" @if($cat->top_menu == 1) checked @endif value="{{ $cat->slug }}" type="checkbox" id="test{{$key}}"/>
                                        <label for="test{{ $key }}">{{ $cat->name }}</label>
                                        <span class="error">{{ $errors->first('category') }}</span>
                                    </div>
                                @endforeach
                                <div class="input-field col s12">
                                    <button class="btn cyan waves-effect waves-light submitBtn" type="submit">
                                        Submit
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
        $(document).ready(function () {
            $(".category").change(function () {
                var maxAllowed = 5;
                var cnt = $(".category:checked").length;
                if (cnt > maxAllowed) {
                    $(this).prop("checked", "");
                    $.notify("Select maximum " + maxAllowed + " categories!", "error");
                }
            });
        });

    </script>
@endsection
