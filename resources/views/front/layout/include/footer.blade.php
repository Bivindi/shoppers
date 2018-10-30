<!-- =========================
        Footer Section
    ============================== -->
<footer id="footer" class=" wow fadeInUp animated footer-2" data-wow-delay="900ms">
    <div class="container-fluid custom-width">
        <div class="row">
            <div class="col-md-12 col-lg-3">
                <!-- ===========================
                        Footer About
                     =========================== -->
                <div class="footer-about">
                    <a href="{{ url('') }}" class="footer-about-logo">
                        <img src="{{ asset('front/img/logo.png') }}" alt="Logo">
                    </a>
                     <!-- <h6 class="footer-subtitle">Festival Deals</h6> -->
                        <ul>
                            <li><a class="location" href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp; Your address here </a></li>
                            <li><a class="phone" href="#"><i class="fa fa-phone"></i> &nbsp;&nbsp; 0987654321</a></li>
                            <li><a class="email" href="#"><i class="fa fa-envelope-o"></i>&nbsp;&nbsp; info@productdemo.com</a></li>
                            <li><a class="mobile" href="#"><i class="fa fa-mobile" aria-hidden="true"></i>&nbsp;&nbsp; Hotline: 0987654321</a></li>
                        </ul>
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-3 footer-nav">
                <!-- ===========================
                        Festival Deals
                     =========================== -->
                <h6 class="footer-subtitle">COMPANY</h6>
                <ul>
                    <li><a href="{{ route('get:about_us') }}">About Us</a></li>
                    <!--<li><a href="#">Testimonials</a></li>-->
                    <li><a href="{{ route('get:terms_conditions') }}">Terms & Conditions</a></li>
                    <li><a href="{{ route('get:contact_us') }}">Contact Us</a></li>
                    <li><a href="{{ route('get:delivery_info') }}">Delivery Info</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-3 col-lg-3 footer-nav">
                <!-- ===========================
                        Top Stores
                     =========================== -->
                <div class="stores-list">
                    <h6 class="footer-subtitle">MY ACCOUNT</h6>
                    <ul>
                        <li><a href="{{ route('get:your_orders') }}">My Order</a></li>
                        <li><a href="{{ route('get:wish_list') }}">My Wishlist</a></li>
                        <li><a href="{{ route('get:compare') }}">Compare</a></li>
                        <li><a href="{{ route('get:user_profile') }}">My Profile</a></li>
                        <li><a href="{{ route('get:user_profile') }}">My Address</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-3 footer-nav">
                <!-- ===========================
                        Need Help ?
                     =========================== -->
                <h6 class="footer-subtitle">SUPPORT</h6>
                <ul>
                    <li><a href="{{ route('get:cancellation_policy') }}">Cancellation & Returns</a></li>
                    <li><a href="{{ route('get:privacy_policy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('get:seller_policy') }}">Seller Policy</a></li>
                    <li><a href="{{ route('get:faq_support') }}">FAQ & Support Online</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- =========================
        CopyRight
    ============================== -->
<section id="copyright" class="wow fadeInUp animated copyright-2" data-wow-delay="1500ms">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="copyright-text">
                    <p class="text-uppercase">Copyright © 2018 productdemo. All Rights Reserved. Designed by: productdemo</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="brand-logo">
                    <a href="#">
                        <img src="{{ asset('front/') }}/assets/data/option4/payment-logo.png" class="img-fluid" alt="payment logo">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>