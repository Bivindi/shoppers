<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('metadescription')">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- =========================
        Loding All Stylesheet
    ============================== -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/jquery-ui/jquery-ui.css') }}"/>
    <link rel="stylesheet" href="{{ asset('front/css/animate.min.css') }}">

    <link rel="stylesheet" href="{{ asset('front/css/megamenu.css') }}">
    
    

    <!-- =========================
        Loding Main Theme Style
    ============================== -->
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/custome.css') }}">

    <!-- =========================
    	Header Loding JS Script
    ============================== -->
    <script src="{{ asset('front/js/modernizr.js') }}"></script>
    @yield('page-css')
</head>