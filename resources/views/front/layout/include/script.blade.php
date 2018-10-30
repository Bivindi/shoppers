<!-- =========================
    	Main Loding JS Script
    ============================== -->
<script src="{{ asset('front/js/jquery.min.js') }}"></script>
<script src="{{ asset('front/js/jquery-ui.js') }}"></script>
<script type="text/javascript"
src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('front/js/popper.js') }}"></script>
<script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('front/js/jquery.nav.js') }}"></script>
<!-- <script src="{{ asset('front/js/jquery.nicescroll.js"></') }}script> -->
<script src="{{ asset('front/js/jquery.rateyo.js') }}"></script>
<script src="{{ asset('front/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('front/js/jquery.sticky.js') }}"></script>
<script src="{{ asset('front/js/mobile.js') }}"></script>
<script src="{{ asset('front/js/lightslider.min.js') }}"></script>
<script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('front/js/circle-progress.min.js') }}"></script>
<script src="{{ asset('front/js/jquery.waypoints.js') }}"></script>

<script src="{{ asset('front/js/simplePlayer.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" type="text/javascript"></script>

<script src="{{ asset('front/js/main.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

<script type="text/javascript">
	@if (Session::has('success'))
    $.notify("{{ Session::get('success') }}", "success");
    @endif
    @if (Session::has('error'))
    $.notify("{{ Session::get('error') }}", "error");
    @endif

	$("#registrationForm").validate({
        rules: {
            first_name: 'required',
            last_name: 'required',
            username: 'required',
            email: {
                required: true,
                email: true
            },
            password: 'required',
            cpassword: {
                required: true,
                equalTo: "#pwd"
            },
            mobile_num: {
                required: true,
                minlength: 9,
                maxlength: 10,
                number: true
            },
        },
        //For custom messages
        messages: {
            first_name: "Please enter your first name..!",
            last_name: "Please enter your last name..!",
            username: "Please enter your username..!",
            email: "Please enter your email..!",
            password: "Please enter your password..!",
            cpassword: "Password does not match..!",
            mobile_num: "Enter your mobile number..!"
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error);
                $(".submitBtn").addClass('shakeBtn');
            } else {
                error.insertAfter(element);
                $(".submitBtn").addClass('shakeBtn');
            }
        }
    });

    $("#loginForm").validate({
        rules: {
            username_or_mobile: 'required',
            password: 'required',
        },
        //For custom messages
        messages: {
            username_or_mobile: "Please enter your username or mobile number..!",
            password: "Please enter your password..!",
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error);
                $(".loginBtn").addClass('shakeBtn');
            } else {
                error.insertAfter(element);
                $(".loginBtn").addClass('shakeBtn');
            }
        }
    });

    $(document).on('submit', '#forgotForm', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: "{{ route('post:forgot_password_mail') }}",
            data: $(this).serialize(),
            beforeSend: function () {
                $(".submitBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw text-center"></i>');
                $(".submitBtn").attr('disabled', true);
            },
            success: function (result) {
                if (result.success == true) {
                    $('#login').modal('hide');
                    $('#forgotForm')[0].reset();
                    $(".submitBtn").html('Submit');
                    $(".submitBtn").attr('disabled', false);
                    location.reload();
                }
                if (result.success == false) {
                    $.notify(result.message, "error");
                    shakeModal();
                    $(".submitBtn").html('Submit');
                    $(".submitBtn").attr('disabled', false);
                }
                if (result.error == true) {
                    $.each(result.message, function (index, error) {
                        var keys = Object.keys(result.message);
                        $('input[name="' + keys[0] + '"]').focus();
                        $('.' + index + '_error').html(error);
                    });
                    shakeModal();
                    $(".submitBtn").html('Submit');
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
                    $('#login').modal('hide');
                    $('#loginForm')[0].reset();
                    $(".loginBtn").html('Login');
                    $(".loginBtn").attr('disabled', false);
                    // if($.cookie("url")){
                    //     window.location.href = $.cookie("url");
                    // }else {
                        location.reload();
                    // }
                }
                console.log(result);
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
                    $('#login').modal('hide');
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

</script>
@yield('page-js')