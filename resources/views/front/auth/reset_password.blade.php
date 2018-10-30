@extends('front.auth.layout.default')
@section('title')
    Reset Password
@endsection
@section('body-class')
    class="category-page"
@endsection
@section('page-content')
    <div class="columns-container">
        <div class="container" id="columns">
            <!-- breadcrumb -->
            <div class="breadcrumb clearfix">
                <a class="home" href="{{ route('get:homepage') }}" title="Return to Home">Home</a>
                <span class="navigation-pipe">&nbsp;</span>
                <span class="navigation_page">Reset Password</span>
            </div>
            <!-- ./breadcrumb -->
            <h2 class="page-heading">
                <span class="page-heading-title2">Reset Password</span>
            </h2>
            <!-- row -->
            <div id="contact" class="page-content page-contact">
                <div id="message-box-conact"></div>
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="page-subheading">RESET FORM</h3>
                        <form id="resetForm">
                            {{ csrf_field() }}
                            <input type="hidden" name="code" value="{{ $code }}">
                            <div class="contact-form-box">
                                <div class="form-selector">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control input-sm" id="newpwd" />
                                    <span class="error error_password"></span>
                                </div>
                                <div class="form-selector">
                                    <label>Repeat Password</label>
                                    <input type="password" name="cpassword" class="form-control input-sm"/>
                                    <span class="error error_cpassword"></span>
                                </div>
                                <div class="form-selector">
                                    <button type="submit" id="btn-send-contact" class="btn loginBtn">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-12 col-sm-6" id="contact_form_map">
                        <h3 class="page-subheading">Information</h3>
                        <p>Lorem ipsum dolor sit amet onsectetuer adipiscing elit. Mauris fermentum dictum magna. Sed
                            laoreet aliquam leo. Ut tellus dolor dapibus eget. Mauris tincidunt aliquam lectus sed
                            vestibulum. Vestibulum bibendum suscipit mattis.</p>
                        <br/>
                        <ul>
                            <li>Praesent nec tincidunt turpis.</li>
                            <li>Aliquam et nisi risus.&nbsp;Cras ut varius ante.</li>
                            <li>Ut congue gravida dolor, vitae viverra dolor.</li>
                        </ul>
                        <br/>
                        <ul class="store_info">
                            <li><i class="fa fa-home"></i>Our business address is 1063 Freelon Street San Francisco, CA
                                95108
                            </li>
                            <li><i class="fa fa-phone"></i><span>+ 021.343.7575</span></li>
                            <li><i class="fa fa-phone"></i><span>+ 020.566.6666</span></li>
                            <li><i class="fa fa-envelope"></i>Email: <span><a
                                            href="mailto:%73%75%70%70%6f%72%74@%6b%75%74%65%74%68%65%6d%65.%63%6f%6d">support@kutetheme.com</a></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script type="text/javascript" src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(document).on('submit', '#resetForm', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: "{{ route('post:reset_password') }}",
                data: $(this).serialize(),
                beforeSend: function () {
                    $(".loginBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw text-center"></i>');
                    $(".loginBtn").attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        $('#resetForm')[0].reset();
                        $(".loginBtn").html('Reset');
                        $(".loginBtn").attr('disabled', false);
                        window.location.href = result.url
                    }
                    if (result.success == false) {
                        $.notify(result.message, "error");
                        shakeModal();
                        $(".loginBtn").html('Reset');
                        $(".loginBtn").attr('disabled', false);
                    }
                    if (result.error == true) {
                        $.each(result.message, function (index, error) {
                            var keys = Object.keys(result.message);
                            $('input[name="' + keys[0] + '"]').focus();
                            $('.' + index + '_error').html(error);
                        });
                        shakeModal();
                        $(".loginBtn").html('Reset');
                        $(".loginBtn").attr('disabled', false);
                    }
                }
            });
        });

        $("#resetForm").validate({
            rules: {
                password: 'required',
                cpassword: {
                    required: true,
                    equalTo: "#newpwd"
                }
            },
            //For custom messages
            messages: {
                password: "Please enter your password..!",
                cpassword: "Password does not match..!",
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
    </script>
@endsection
