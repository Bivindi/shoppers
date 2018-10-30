@extends('admin.layout.default')
@section('title')
    Assign Permission
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
                        <h5 class="breadcrumbs-title">Assign Permission</h5>
                        <ol class="breadcrumbs">
                            <li><a href="javascript:void(0);">Permission</a>
                            </li>
                            <li class="active">Assign Permission</li>
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
                        <h4 class="header2">Assign Permission</h4>
                        <div class="row">
                            <form id="formValidate" class="col s12" action="{{ route('post:assign_permission') }}"
                                  method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select name="employee" id="employee">
                                            <option value="" disabled>Select Employee</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                                            @endforeach
                                        </select>
                                        <label for="employee">Employee</label>
                                        <span class="error">{{ $errors->first('employee') }}</span>
                                    </div>
                                    <div class="input-field col s12">
                                        <p>Permission</p>
                                        @foreach($permissions as $key => $permission)
                                            <input name="permission[]" value="{{ $permission->id }}" type="checkbox" id="test{{$key}}"/>
                                            <label for="test{{$key}}">{{ $permission->name }}</label>
                                        @endforeach
                                        <span class="error">{{ $errors->first('permission') }}</span>
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
@endsection
