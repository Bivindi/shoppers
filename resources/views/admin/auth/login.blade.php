@extends('admin.auth.layout.default')

@section('page-css')
    <link href="{{ asset('assets/css/layouts/page-center.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <style>
        .error{
            margin-left: 3rem;
        }
    </style>
@endsection
@section('page-content')
    <div id="login-page" class="row">
        <div class="col s12 z-depth-4 card-panel">
            <form class="login-form" action="{{ route('post:login') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="input-field col s12 center">
                        <img src="{{ asset('assets/images/login-logo1.png') }}" alt=""
                             class="circle responsive-img valign profile-image-login">
                        <p class="center login-form-text">shopper Beem</p>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-social-person-outline prefix"></i>
                        <input id="username" name="username" required type="text">
                        <label for="username" class="center-align">Username</label>
                        <span class="error">{{ $errors->first('username') }}</span>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-action-lock-outline prefix"></i>
                        <input id="password" name="password" required type="password">
                        <label for="password">Password</label>
                        <span class="error">{{ $errors->first('password') }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12 l12  login-text">
                        <input type="checkbox" id="remember-me"/>
                        <label for="remember-me">Remember me</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="btn waves-effect waves-light col s12">Login</button>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 m6 l6">
                        <p class="margin medium-small"><a href="{{ route('get:register') }}">Register Now!</a></p>
                    </div>
                    <div class="input-field col s6 m6 l6">
                        <p class="margin right-align medium-small"><a href="#">Forgot password ?</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection