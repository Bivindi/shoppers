<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/lib/bootstrap/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('front/assets/lib/font-awesome/css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/lib/select2/css/select2.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/lib/jquery.bxslider/jquery.bxslider.css') }}"/>
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/lib/owl.carousel/owl.carousel.css') }}"/>--}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.6/assets/owl.carousel.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/lib/jquery-ui/jquery-ui.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/lib/fancyBox/jquery.fancybox.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/animate.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/reset.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/style.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/responsive.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login-register.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <style>
        .error {
            font-size: 12px;
            color: #e74b24;
            padding-top: 1px;
            clear: both;
        }

        #header {
            background: #0d0d0d;
        }

        .fancybox-overlay {
            z-index: 100000 !important;
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

        @if(isset($footerImage))
        #footer2 .footer-paralax {
            background: url('{{ asset('slider/'.$footerImage->footer_slider ) }}') 50% 0 no-repeat fixed;
        }
        @endif
    </style>
    @yield('page-css')
</head>
<body class="category-page">
<!-- HEADER -->
@include('front.auth.layout.include.header')
<!-- end header -->
<!-- page wapper-->
@yield('page-content')
<!-- ./page wapper-->
<!-- Footer -->
<div class="modal fade" id="defaultModal">
    <div class="modal-dialog modal-md animated">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
@include('front.layout.include.footer')
<a href="#" class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>
<!-- Script-->
<script type="text/javascript" src="{{ asset('front/assets/lib/jquery/jquery-1.11.2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/assets/lib/bootstrap/js/bootstrap.min.js') }}"></script>
{{--<script type="text/javascript" src="{{ asset('front/assets/lib/owl.carousel/owl.carousel.min.js') }}"></script>--}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.6/owl.carousel.min.js"></script>
<script type="text/javascript" src="{{ asset('front/assets/lib/select2/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/assets/lib/jquery.bxslider/jquery.bxslider.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/assets/lib/jquery.countdown/jquery.countdown.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/assets/lib/jquery.elevatezoom.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/assets/lib/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/assets/lib/fancyBox/jquery.fancybox.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/assets/js/jquery.actual.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/assets/js/theme-script.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('js/jquery.easy-autocomplete.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" type="text/javascript"></script>
<script src="{{ asset('js/main.js') }}"></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/5aa66299d7591465c7087a95/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
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
        getWishListCount();
    });

    function getWishListCount() {
        $.ajax({
            type: 'get',
            url: "{{ route('get:wishlist_count') }}",
            success: function (result) {
                if (result.success == true) {
                    $('.wishlist-count').html(result.count);
                }
            }
        });
    }

    $(document).on('submit', '#registrationForm', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: "{{ route('post:user_register') }}",
            data: $(this).serialize(),
            beforeSend: function () {
                $(".submitBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw text-center"></i>');
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
                $(".loginBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw text-center"></i>');
                $(".loginBtn").attr('disabled', true);
            },
            success: function (result) {
                if (result.success == true) {
                    $('#loginModal').modal('hide');
                    $('#loginForm')[0].reset();
                    $(".loginBtn").html('Login');
                    $(".loginBtn").attr('disabled', false);
                    if ($.cookie("url")) {
                        window.location.href = $.cookie("url");
                    } else {
                        location.reload();
                    }
                }
                if (result.success == false) {
                    $.notify(result.message, "error");
                    shakeModal();
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
                    $(".loginBtn").html('Login');
                    $(".loginBtn").attr('disabled', false);
                }
            }
        });
    });

    function shakeModal() {
        $('#loginModal .modal-dialog').addClass('shake');
        setTimeout(function () {
            $('#loginModal .modal-dialog').removeClass('shake');
        }, 1000);
    }

    $(function () {
        $(".buttonqty").on("click", function () {
            var $button = $(this);
            var cartId = $button.attr('cartId');
            var oldValue = $button.parent().parent().find('.qty').find("input.quantity").val();
            if ($button.hasClass('btn-plus-up')) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below zero
                if (oldValue == 1) {
                    return false;
                } else {
                    var newVal = parseFloat(oldValue) - 1;
                }
            }
            updateCartQuantity(cartId, newVal, $button);
        });
    });

    function updateCartQuantity(cartId, newVal, $button) {
        $.ajax({
            type: 'get',
            url: "{{ route('post:update_cart_quantity') }}",
            data: {cartId: cartId, quantity: newVal},
            beforeSend: function () {
                $(".loginBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                $(".loginBtn").attr('disabled', true);
            },
            success: function (result) {
                if (result.success == true) {
                    $button.parent().parent().find('.qty').find('input.quantity').val(newVal);
                    location.reload();
                }
                if (result.success == false) {
                    $.notify(result.message, "error");
                }
            }
        });
    }
</script>
@yield('page-js')
</body>
</html>