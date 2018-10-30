<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/') }}/assets/lib/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('front/') }}/assets/lib/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/') }}/assets/lib/select2/css/select2.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/') }}/assets/lib/jquery.bxslider/jquery.bxslider.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/') }}/assets/lib/owl.carousel/owl.carousel.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/') }}/assets/lib/jquery-ui/jquery-ui.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/lib/fancyBox/jquery.fancybox.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/') }}/assets/css/animate.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/') }}/assets/css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/') }}/assets/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/') }}/assets/css/responsive.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/') }}/assets/css/option4.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login-register.css') }}"/>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('front/') }}/assets/js/custome.js"></script>
    <title>@yield('title')</title>
    <style>
        #middle-header {
            /*border-top: 1px solid #bfbfbf;*/
            /*margin-top: 20px;*/
            background-color: #daebea;
            margin-bottom: 0.5%;
            padding-bottom: 5px;
        }

        #middle-header h3 {
            background-color: #d9d9d9;
            border-bottom-left-radius: 5px 5px;
            border-bottom-right-radius: 5px 5px;
            padding: 9px;
        }

        #middle-header .btn {
            float: right;
            margin-top: -10px;
            border-radius: 0px;
        }

        .middle-header-symbol {
            margin-top: 5px;
           
        }

        .middle-header-symbol .col-md-2 .fa {
            font-size: 30px;
            padding: 5px;
        }

        .middle-header-content {
            /*margin-top: 100px;*/
            /*border-top: 1px solid #bfbfbf;*/
        }

        .error {
            font-size: 12px;
            color: #e74b24;
            padding-top: 1px;
            clear: both;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #000;
            line-height: 28px;
        }

        .fancybox-overlay{
            z-index: 100000!important;
        }

        .notifyjs-corner {
            z-index: 1000000 !important;
        }

        #product .pb-right-column .fa {
            line-height: inherit;
        }

        .fa-inr{
            line-height: inherit;
        }
        
    </style>
    @yield('page-css')
<script type="text/javascript"> //<![CDATA[ 
var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.comodo.com/" : "http://www.trustlogo.com/");
document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
//]]>
</script>
</head>
<body @yield('body-class')>
<!-- HEADER -->
@include('front.layout.include.header')
<!-- Home slideder-->
@yield('page-content')
<!-- Footer -->
@include('front.layout.include.footer')

<a href="#" class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>
<!-- Script-->
<script type="text/javascript" src="{{ asset('front/') }}/assets/lib/jquery/jquery-1.11.2.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script type="text/javascript" src="{{ asset('front/') }}/assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('front/') }}/assets/lib/select2/js/select2.min.js"></script>
<script type="text/javascript" src="{{ asset('front/') }}/assets/lib/jquery.bxslider/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="{{ asset('front/') }}/assets/lib/owl.carousel/owl.carousel.min.js"></script>
<!-- COUNTDOWN -->
<script type="text/javascript" src="{{ asset('front/assets/lib/countdown/jquery.plugin.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/assets/lib/countdown/jquery.countdown.js') }}"></script>
<!-- ./COUNTDOWN -->
<script type="text/javascript" src="{{ asset('front/assets/js/jquery.actual.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/assets/js/theme-script.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/assets/js/option4.js') }}"></script>
<script type="text/javascript"
src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script type="text/javascript"
src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/assets/lib/fancyBox/jquery.fancybox.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/assets/lib/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" type="text/javascript"></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5aa66299d7591465c7087a95/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<script type="text/javascript">
    @if (Session::has('success'))
    $.notify("{{ Session::get('success') }}", "success");
    @endif
    @if (Session::has('error'))
    $.notify("{{ Session::get('error') }}", "error");
    @endif

    $(document).on('keyup', '#autocomplete', function () {
        var src = "{{ route('get:search_suggestion') }}";
        autocomplete(src);
    });

    function autocomplete(src) {
        $("#autocomplete").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: src,
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                event.preventDefault();
                $("#autocomplete").val(ui.item.name);
                $("#searchForm").append('<input type="hidden" name="searchcat" value="' + ui.item.slug + '">');
            },
            minLength: 3,
        });
    }

    $(document).on('click', '#loginRegister', function (e) {
        e.preventDefault();
        var modal = $('#loginModal');
        setTimeout(function () {
            modal.modal('show');
        }, 230);
        $.ajax({
            type: 'get',
            url: "{{ route('get:login_form') }}",
            success: function (result) {
                $('.modal-content').html(result);
            }
        });
    });

    $(document).on('click', '.user-dropdown', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'get',
            url: "{{ route('get:wishlist_count') }}",
            success: function (result) {
                if (result.success == true) {
                    $('.wishlist-count').html(result.count);
                }
            }
        });
    });

    $(document).on('submit', '#registrationForm', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: "{{ route('post:user_register') }}",
            data: $(this).serialize(),
            beforeSend: function () {
                $(".submitBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                $(".submitBtn").attr('disabled', true);
            },
            success: function (result) {
                if (result.success == true) {
                    $('#loginModal').modal('hide');
                    $('#registrationForm')[0].reset();
                    $(".submitBtn").html('Create account');
                    $(".submitBtn").attr('disabled', false);
                    location.reload();
                }
                if (result.error == true) {
                    $.each(result.message, function (index, error) {
                        var keys = Object.keys(result.message);
                        $('input[name="' + keys[0] + '"]').focus();
                        $('.' + index + '_error').html(error);
                    });
                    shakeModal();
                    $(".submitBtn").addClass('shakeBtn');
                    $(".submitBtn").html('Create account');
                    $(".submitBtn").attr('disabled', false);
                }
            }
        });
    });

    $(document).on('submit', '#loginForm', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: "{{ route('post:user_login') }}",
            data: $(this).serialize(),
            beforeSend: function () {
                $(".loginBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                $(".loginBtn").attr('disabled', true);
            },
            success: function (result) {
                if (result.success == true) {
                    $('#loginModal').modal('hide');
                    $('#loginForm')[0].reset();
                    $(".loginBtn").html('Login');
                    $(".loginBtn").attr('disabled', false);
                    if($.cookie("url")){
                        window.location.href = $.cookie("url");
                    }else {
                        location.reload();
                    }
                }
                if (result.success == false) {
                    $.notify(result.message, "error");
                    shakeModal();
                    $(".loginBtn").addClass('shakeBtn');
                    $(".loginBtn").html('Login');
                    $(".loginBtn").attr('disabled', false);
                }
                if (result.error == true) {
                    $.each(result.message, function (index, error) {
                        var keys = Object.keys(result.message);
                        $('input[name="' + keys[0] + '"]').focus();
                        $('.' + index + '_error').html(error);
                    });
                    shakeModal();
                    $(".loginBtn").addClass('shakeBtn');
                    $(".loginBtn").html('Login');
                    $(".loginBtn").attr('disabled', false);
                }
            }
        });
    });
</script>
@yield('page-js')

</body>
</html>