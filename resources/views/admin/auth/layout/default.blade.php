<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
    <title>@yield('title')</title>

    <!-- Favicons-->
    <link rel="icon" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/images/favicon/apple-touch-icon-152x152.png') }}">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="{{ asset('assets/images/favicon/mstile-144x144.png') }}">
    <!-- For Windows Phone -->

    <!-- CORE CSS-->
    <link href="{{ asset('assets/css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{ asset('assets/css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->
    <link href="{{ asset('assets/css/custom/custom-style.css') }}" type="text/css" rel="stylesheet" media="screen,projection">

    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="{{ asset('assets/js/plugins/prism/prism.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{ asset('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <style>
        .error{
            color: red;
            display: block;
        }
    </style>
    @yield('page-css')
</head>

<body class="cyan">
<!-- Start Page Loading -->
{{--<div id="loader-wrapper">--}}
    {{--<div id="loader"></div>--}}
    {{--<div class="loader-section section-left"></div>--}}
    {{--<div class="loader-section section-right"></div>--}}
{{--</div>--}}
<!-- End Page Loading -->
@yield('page-content')

<!-- jQuery Library -->
<script type="text/javascript" src="{{ asset('assets/js/plugins/jquery-1.11.2.min.js') }}"></script>
<!--materialize js-->
<script type="text/javascript" src="{{ asset('assets/js/materialize.js') }}"></script>
<!--prism-->
<script type="text/javascript" src="{{ asset('assets/js/plugins/prism/prism.js') }}"></script>
<!--scrollbar-->
<script type="text/javascript" src="{{ asset('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<!--plugins.js - Some Specific JS codes for Plugin Settings-->
<script type="text/javascript" src="{{ asset('assets/js/plugins.js') }}"></script>
<!--custom-script.js - Add your own theme custom JS-->
<script type="text/javascript" src="{{ asset('assets/js/custom-script.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" type="text/javascript"></script>
<script type="text/javascript"
        src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script>
    @if (Session::has('success'))
    $.notify("{{ Session::get('success') }}", "success");
    @endif
    @if (Session::has('error'))
    $.notify("{{ Session::get('error') }}", "error");
    @endif
</script>
@yield('page-js')
</body>
</html>