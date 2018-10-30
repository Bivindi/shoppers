@extends('front.auth.layout.default')
@section('title')
    About Us
@endsection
@section('body-class')
    class="category-page"
@endsection
@section('page-content')
    <div class="columns-container">
        <div class="container" id="columns">
            <!-- breadcrumb -->
            <div class="breadcrumb clearfix">
                <a class="home" href="#" title="Return to Home">Home</a>
                <span class="navigation-pipe">&nbsp;</span>
                <span class="navigation_page">About Us</span>
            </div>
            <!-- ./breadcrumb -->
            <!-- row -->
            <div class="row">
                <!-- Left colunm -->
                <div class="column col-xs-12 col-sm-3" id="left_column">
                    <!-- block category -->
                    <div class="block left-module">
                        <p class="title_block">Infomations</p>
                        <div class="block_content">
                            <!-- layered -->
                            <div class="layered layered-category">
                                <div class="layered-content">
                                    <ul class="tree-menu">
                                        <li class="active"><span></span><a href="{{ route('get:about_us') }}">About
                                                Us</a></li>
                                        <li><span></span><a href="#">Delivery Information</a></li>
                                        <li><span></span><a href="#">Privacy Policy</a></li>
                                        <li><span></span><a href="#">Terms &amp; Conditions</a></li>
                                        <li><span></span><a href="#">Contact Us</a></li>
                                        <li><span></span><a href="#">FAQ</a></li>
                                        <li><span></span><a href="#">Site Map</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- ./layered -->
                        </div>
                    </div>
                    <!-- ./block category  -->
                    <!-- Banner silebar -->
                    @if(count($about)>0)
                        <div class="block left-module">
                            <div class="banner-opacity">
                                <a href="javascript:void(0);">
                                    <img src="{{ asset('otherpages/'.$about->image) }}"
                                         alt="ads-banner"></a>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- ./left colunm -->
                <!-- Center colunm-->
                <div class="center_column col-xs-12 col-sm-9" id="center_column">
                    <!-- page heading-->
                    <h2 class="page-heading">
                        <span class="page-heading-title2">About Us</span>
                    </h2>
                    <!-- Content page -->
                    <div class="content-text clearfix">
                        @if(count($about)>0)
                            {!! $about->desc !!}
                        @endif
                    </div>
                    <!-- ./Content page -->
                </div>
                <!-- ./ Center colunm -->
            </div>
        </div>
    </div>
@endsection
@section('page-js')
@endsection