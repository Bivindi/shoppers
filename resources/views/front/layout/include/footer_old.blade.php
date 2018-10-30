<footer id="footer2">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="footer-logo">
                        <a href="#"><img src="{{ asset('img/lozypay-transparent.png/') }}" alt="Logo"></a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="footer-menu">
                        <ul>
                            <li><a href="{{ route('get:about_us') }}">About Us</a></li>
                            {{--<li><a href="#">Affiliates</a></li>--}}
                            {{--<li><a href="#">Careers</a></li>--}}
                            <li><a href="{{ route('get:privacy_policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('get:terms_conditions') }}">Terms & Conditions</a></li>
                            <li><a href="{{ route('get:contact_us') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="footer-social">
                        <ul>
                            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="pinterest" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                            <li><a class="vk" href="#"><i class="fa fa-vk"></i></a></li>
                            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer paralax-->
    <div class="footer-paralax">
        <div class="footer-row footer-center">
            <div class="container">
                <h3>Sign up below for early updates</h3>
                <p>You a Client , large or small, and want to participate in this adventure, please send us an email to support@productdemo.com</p>                 <form class="form-inline form-subscribe">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter Your E-mail Address">
                        <button type="submit" class="btn btn-default"><i class="fa fa-paper-plane-o"></i></button>
                    </div>

                </form>
            </div>
        </div>
        <div class="footer-row">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="widget-container">
                            <h3 class="widget-title">Infomation</h3>
                            <div class="widget-body">
                                <ul>
                                    <li><a class="location" href="#">No.66, 1st Floor, 19th Street, Shankarik Nagar, Pammal,
Chennai, CG – 600075</a></li>
                                    <li><a class="phone" href="#">6309734245</a></li>
                                    <li><a class="email" href="#">info@productdemo.com</a></li>
                                    <li><a class="mobile" href="#">Hotline: 0987654321</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="widget-container">
                            <h3 class="widget-title">COMPANY</h3>
                            <div class="widget-body">
                                <ul>
                                    <li><a href="{{ route('get:about_us') }}">About Us</a></li>
                                    <!--<li><a href="#">Testimonials</a></li>-->
                                    <li><a href="{{ route('get:terms_conditions') }}">Terms & Conditions</a></li>
                                    <li><a href="{{ route('get:contact_us') }}">Contact Us</a></li>
                                    <li><a href="{{ route('get:delivery_info') }}">Delivery Info</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="widget-container">
                            <h3 class="widget-title">my account</h3>
                            <div class="widget-body">
                                <ul>
                                    <li><a href="{{ route('get:your_orders') }}">My Order</a></li>
                                    <li><a href="{{ route('get:wish_list') }}">My Wishlist</a></li>
                                    <li><a href="{{ route('get:compare') }}">Compare</a></li>
                                    <li><a href="{{ route('get:user_profile') }}">My Profile</a></li>
                                    <li><a href="{{ route('get:user_profile') }}">My Address</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="widget-container">
                            <h3 class="widget-title">SUPPORT</h3>
                            <div class="widget-body">
                                <ul>
                                    <li><a href="{{ route('get:cancellation_policy') }}">Cancellation & Returns</a></li>
                                    <li><a href="{{ route('get:privacy_policy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ route('get:seller_policy') }}">Seller Policy</a></li>
                                    <li><a href="{{ route('get:faq_support') }}">FAQ & Support Online</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-wapper">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="footer-coppyright">
                                Copyright © 2015 LozyPay. All Rights Reserved. Designed by: LozyPay
                            </div>

                        </div>
                        <div class="col-sm-4">
                            <div class="footer-payment-logo">
                                <img src="{{ asset('front/') }}/assets/data/option4/payment-logo.png" alt="payment logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./footer paralax-->
</footer>