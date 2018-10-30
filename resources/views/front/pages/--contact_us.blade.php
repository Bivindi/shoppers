@extends('front.auth.layout.default')
@section('title')
    Contact Us
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
                <span class="navigation_page">Contact</span>
            </div>
            <!-- ./breadcrumb -->
            <h2 class="page-heading">
                <span class="page-heading-title2">Contact Us</span>
            </h2>
            <!-- row -->
            <div id="contact" class="page-content page-contact">
                <div id="message-box-conact"></div>
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="page-subheading">CONTACT FORM</h3>
                        <form id="formValidate" action="{{ route('post:contact_us') }}" method="post">
                            {{ csrf_field() }}
                            <div class="contact-form-box">
                                <div class="form-selector">
                                    <label>Subject Heading</label>
                                    <input type="text" name="subject" class="form-control input-sm"/>
                                </div>
                                <div class="form-selector">
                                    <label>Email address</label>
                                    <input type="email" name="email" class="form-control input-sm" id="email"/>
                                    <span class="error">{{ $errors->first('email') }}</span>
                                </div>
                                <div class="form-selector">
                                    <label>Order reference</label>
                                    <input type="text" name="order_reference" class="form-control input-sm" id="order_reference"/>
                                </div>
                                <div class="form-selector">
                                    <label>Message</label>
                                    <textarea class="form-control input-sm" name="message" rows="10" id="message"></textarea>
                                    <span class="error">{{ $errors->first('message') }}</span>
                                </div>
                                <div class="form-selector">
                                    <button type="submit" id="btn-send-contact" class="btn">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-12 col-sm-6" id="contact_form_map">
                        <h3 class="page-subheading">Information</h3>
                        
                        
                        
                        
                        <ul class="store_info">
                            <li><i class="fa fa-home"></i>No.66, 1st Floor, 19th Street, Shankar Nagar, Pammal,
Chennai, Tamilnadu – 600075
                            </li>
                            <li><i class="fa fa-phone"></i><span>+ 91-8778783053</span></li>
                            <li><i class="fa fa-phone"></i><span>+ 91-6309734245</span></li>
                            <li><i class="fa fa-envelope"></i>Email: <span><a
                                            href="mailto:support24*7@lozypay.com">support24*7@lozypay.com</a></span>
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
        $("#formValidate").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                message: 'required',
                subject: 'required',
            },
            //For custom messages
            messages: {
                email: "Please enter your email..!",
                message: "Please enter your message..!",
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