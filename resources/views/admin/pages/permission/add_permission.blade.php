@extends('admin.layout.default')
@section('title')
    Add Permission
@endsection
@section('page-css')
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
                        <h5 class="breadcrumbs-title">Add Permission</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Permission</a>
                            </li>
                            <li class="active">Add Permission</li>
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
                        <h4 class="header2">Add Permission</h4>
                        <div class="row">
                            <form id="formValidate" class="col s12" action="{{ route('post:add_permission') }}"
                                  method="post">
                                {{ csrf_field() }}
                                @if(isset($permission))
                                    <input type="hidden" name="permissionId" value="{{ $permission->id }}">
                                @endif
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input id="name" name="name"
                                               value="{{ (isset($permission)) ? $permission->name : old('name') }}"
                                               type="text">
                                        <label for="name">Name</label>
                                        <span class="error">{{ $errors->first('name') }}</span>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="display_name" name="display_name"
                                               value="{{ (isset($permission)) ? $permission->display_name : old('display_name') }}"
                                               type="text">
                                        <label for="display_name">Display Name</label>
                                        <span class="error">{{ $errors->first('display_name') }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea id="desc"
                                                  class="materialize-textarea" name="description">{{ (isset($permission)) ? $permission->description : old('description') }}</textarea>
                                        <label for="desc">Description</label>
                                        <span class="error">{{ $errors->first('description') }}</span>
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
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
        });


        $("#formValidate").validate({
            rules: {
                name: 'required',
                display_name: 'required',
                description: 'required'
            },
            //For custom messages
            messages: {
                name: "Please enter your username..!",
                display_name: "Please enter your username..!",
                description: "Please enter your username..!"
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
