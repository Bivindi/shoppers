<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
<title>Hostbox</title>
<link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/slick.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/purple-theme.css') }}">
<style type="text/css">
  a.signup-button:hover{
    color:#fff!important;
    text-decoration: none!important;
  }
  a:hover{
    color:#fff!important;
    text-decoration: none!important;
  }
</style>
</head>

<body onload="init();">
<div id="top-content" class="container-fluid">
  <div class="color-overlay accent-color-bg"></div>
  <div class="container-fluid logo-menu">
    <div class="container">
      <div class="row">
        <div class="col-xs-6 text-left">
          <canvas id="logo-canvas" width="50" height="50"></canvas>
          <div class="logo-txt">Hostbox</div>
        </div>
        <div class="col-xs-6 text-right">
          <div id="default-button" class="menu-button">
            <div class="fa fa-circle-o"></div>
            <div class="fa fa-circle-o"></div>
            <div class="fa fa-circle-o"></div>
          </div>
            <div id="default-menu" class="fullpage-menu">
                <div class="close-btn"><img src="{{ asset('admin_assets/images/close-btn.png') }}" alt=""></div>
                <div class="menu-holder">
                    <ul>
                        <li><a class="menu-link" href="#header">Home</a></li>
                        <li><a class="menu-link" href="#features">Features</a></li>
                        <li><a class="menu-link" href="#pricing">Pricing</a></li>
                        <li><a class="menu-link" href="#contact">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row header-content">
      <div class="col-xs-12 text-center">
        <div class="header-text-1"> 
          <div class="word">Affordable</div>
        </div>
        <div class="header-text-2">Shared Hosting</div>
        <div class="header-text-3">Starting From As Low As
          <div class="currency">$</div>
          <div class="price">0.99</div>
          <div class="duration">/Mo</div>
        </div>
        <a href="{{ url('admin/login') }}" class="signup-button">Sign in</a>&nbsp;&nbsp;
        <a href="{{ url('admin/register') }}" class="signup-button">Sign Up</a>
      </div>
    </div>
  </div>
</div>
<div id="partners" class="container-fluid">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="partners-slider">
          <div><img src="{{ asset('admin_assets/images/partners/1.jpg') }}" alt=""></div>
          <div><img src="{{ asset('admin_assets/images/partners/2.jpg') }}" alt=""></div>
          <div><img src="{{ asset('admin_assets/images/partners/3.jpg') }}" alt=""></div>
          <div><img src="{{ asset('admin_assets/images/partners/4.jpg') }}" alt=""></div>
          <div><img src="{{ asset('admin_assets/images/partners/5.jpg') }}" alt=""></div>
          <div><img src="{{ asset('admin_assets/images/partners/6.jpg') }}" alt=""></div>
          <div><img src="{{ asset('admin_assets/images/partners/7.jpg') }}" alt=""></div>
          <div><img src="{{ asset('admin_assets/images/partners/8.jpg') }}" alt=""></div>
          <div><img src="{{ asset('admin_assets/images/partners/9.jpg') }}" alt=""></div>
          <div><img src="{{ asset('admin_assets/images/partners/10.jpg') }}" alt=""></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="features" class="container-fluid">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 row-title accent-color-text"> Our Hosting Features </div>
    </div>
    <div class="row feature-buttons-holder">
      <div class="box3d">
        <div class="box3d-top box3d-part accent-color-bg"></div>
        <div class="box3d-left box3d-part accent-color-bg"></div>
        <div class="box3d-right box3d-part accent-color-bg"></div>
      </div>
      <div class="feature-button feature1 color1-bg inside-box-left" data-num="1">
        <div class="feature-icon"><img src="{{ asset('admin_assets/images/icons8-shirt-66.png') }}" alt=""></div>
        <div class="feature-title">Register</div>
        <div class="feature-line color1-border feature-line-hide"></div>
        <div class="feature-star fa fa-star color1 feature-star-hide"></div>
      </div>
      <div class="feature-button feature2 color2-bg inside-box-left" data-num="2">
        <div class="feature-icon"><img src="{{ asset('admin_assets/images/icons8-user-groups-66.png') }}" alt=""></div>
        <div class="feature-title">Receive orders</div>
        <div class="feature-line color2-border feature-line-hide"></div>
        <div class="feature-star fa fa-star color2 feature-star-hide"></div>
      </div>
      <div class="feature-button feature3 color3-bg inside-box-right" data-num="3">
        <div class="feature-icon"><img src="{{ asset('admin_assets/images/icons8-truck-66.png') }}" alt=""></div>
        <div class="feature-title">Package & ship</div>
        <div class="feature-line color3-border feature-line-hide"></div>
        <div class="feature-star fa fa-star color3 feature-star-hide"></div>
      </div>
      <div class="feature-button feature4 color4-bg inside-box-right" data-num="4">
        <div class="feature-icon"><img src="{{ asset('admin_assets/images/icons8-money-bag-rupee-66.png') }}" alt=""></div>
        <div class="feature-title">Get payments</div>
        <div class="feature-line color4-border feature-line-hide"></div>
        <div class="feature-star fa fa-star color4 feature-star-hide"></div>
      </div>
    </div>
  </div>
</div>
<div id="feature-details1" class="container-fluid f-details color1-bg hide-f-details">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="feature-icon"><img src="{{ asset('admin_assets/images/icons8-shirt-66.png') }}" alt=""></div>
        <div class="feature-title">Step 1: Register and list your products</div>
        <div class="feature-text">
          <ul>
            <li>Register your business for free and create a product catalogue. Get free training on how to run your online business</li>
            <li>Get your documentation, photo-shoots, cataloguing, etc. done with ease from our Professional Services network</li>
            <li>Our Snapdeal Advisors will help you at every step and fully assist you in taking your business online</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="feature-details2" class="container-fluid f-details color2-bg hide-f-details">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="feature-icon"><img src="{{ asset('admin_assets/images/icons8-user-groups-66.png') }}" alt=""></div>
        <div class="feature-title">Step 2: Receive orders and sell across India</div>
        <div class="feature-text">
          <ul>
            <li>Once listed, your products will be available to millions of users across India</li>
            <li>Get orders and manage your online business via our top of the line Seller Panel and Seller Zone Mobile App</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="feature-details3" class="container-fluid f-details color3-bg hide-f-details">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="feature-icon"><img src="{{ asset('admin_assets/images/icons8-truck-66.png') }}" alt=""></div>
        <div class="feature-title">Step 3: Package and ship with ease</div>
        <div class="feature-text">
          <ul>
            <li>On receiving orders, pack the goods & leave the worries of pick-up & delivery to our courier partners</li>
            <li>With Snapdeal Plus facility, simply hand over the responsibilities of inventory storage, packaging & delivering the orders to us</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="feature-details4" class="container-fluid f-details color4-bg hide-f-details">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="feature-icon"><img src="{{ asset('admin_assets/images/icons8-money-bag-rupee-66.png') }}" alt=""></div>
        <div class="feature-title">Step 4: Get payments and grow your business</div>
        <div class="feature-text"> <ul>
            <li>Receive quick and hassle-free payments in your account once your orders are fulfilled</li>
            <li>Expand your business with low interest & collateral-free business loans through Capital Assist</li>
          </ul></div>
      </div>
    </div>
  </div>
</div>
<div id="pricing" class="container-fluid">
  <div class="container">
   <!--  <div class="row">
      <div class="col-xs-12 row-title accent-color-text"> Pricing Lists </div>
    </div> -->
    <div class="row">
      <div class="col-xs-12 row-sub-title accent-color-text" style="margin-top: 60px;margin-bottom: 0px;">
      <h1>Start your business with Shopper beem & reach customers across India</h1>
      </div>
    </div>
    <div class="row">
    	<div class="col-md-4 col-sm-12 col-sm-offset-4 price-column">
          <div class="price-table pr-color1">
              <div class="price-top-bar">
                  <div class="pbar color1-bg"></div>
                  <div class="diamond">
                      <div class="diamond-back"><div class="color1-bg"></div></div>
                      <div class="diamond-top"><div class="color1-bg"></div></div>
                      <div class="diamond-bottom"><div class="color1-bg"></div></div>
                  </div>
              </div>
              <a href="{{ url('admin/register') }}"><div class="price-title color1-bg">START SELL NOW</div></a>
             <!--  <div class="price accent-color-text">
                  <span class="monthly-num"><span class="currency">$</span>9.99</span>
              </div>
              <div class="duration accent-color-text">
                  <span class="monthly-obj">/monthly</span>
              </div> -->
              <!-- <ul class="details-list">
                  <li>GB 1000 Storage</li>
                  <li>GB 2000 Monthly Traffic</li>
                  <li>128Mb Ram</li>
                  <li>10Subdomains</li>
                  <li>Sharing data</li>
                  <li>Unlimited Email accounts</li>
                  <li>Support 24/7</li>
                  <li>Linux server</li>
              </ul>
              <a href="#" class="price-btn"><div class="pr-signup-button accent-color-bg">Sign Up</div></a> -->
          </div>
      </div>
       
    </div>
  </div>
</div>
<div id="info1" class="container-fluid info">
  <div class="container">
    <div class="row">
    	<div class="col-md-8 info-text">
        	<h2 class="info-color1">Feature 1</h2>
            <ul class="fa-ul">
            	<li>
                <i class="fa-li fa fa-circle-thin info-color1"><i class="fa fa-check info-color1"></i></i>Duis posuere blandit orci sed tincidunt. Curabitur porttitor nisi ac nunc ornare, in fringilla nisl blandit</li>
                <li><i class="fa-li fa fa-circle-thin info-color1"><i class="fa fa-check info-color1"></i></i>Duis posuere blandit orci sed tincidunt. Curabitur porttitor nisi ac nunc ornare, in fringilla nisl blandit</li>
            </ul>
        </div>
        <div class="col-md-4 info-image">
        	<img src="{{ asset('admin_assets/images/computer.png') }}" alt="">
        </div>
    </div>
  </div>
</div>
<div id="info2" class="container-fluid info">
  <div class="container">
    <div class="row">
    	<div class="col-md-4 info-image">
        	<img src="{{ asset('admin_assets/images/mobile.png') }}" alt="">
        </div>
    	<div class="col-md-8 info-text">
        	<h2 class="info-color2">Feature 2</h2>
            <ul class="fa-ul">
            	<li><i class="fa-li fa fa-circle-thin info-color2"><i class="fa fa-check info-color2"></i></i>Duis posuere blandit orci sed tincidunt. Curabitur porttitor nisi ac nunc ornare, in fringilla nisl blandit</li>
                <li><i class="fa-li fa fa-circle-thin info-color2"><i class="fa fa-check info-color2"></i></i>Duis posuere blandit orci sed tincidunt. Curabitur porttitor nisi ac nunc ornare, in fringilla nisl blandit</li>
            </ul>
        </div>
    </div>
  </div>
</div>
<div id="info3" class="container-fluid info">
  <div class="container">
    <div class="row">
    	<div class="col-md-8 info-text">
        	<h2 class="info-color3">Feature 3</h2>
            <ul class="fa-ul">
            	<li><i class="fa-li fa fa-circle-thin info-color3"><i class="fa fa-check info-color3"></i></i>Duis posuere blandit orci sed tincidunt. Curabitur porttitor nisi ac nunc ornare, in fringilla nisl blandit</li>
                <li><i class="fa-li fa fa-circle-thin info-color3"><i class="fa fa-check info-color3"></i></i>Duis posuere blandit orci sed tincidunt. Curabitur porttitor nisi ac nunc ornare, in fringilla nisl blandit</li>
            </ul>
        </div>
        <div class="col-md-4 info-image">
        	<img src="{{ asset('admin_assets/images/contact.png') }}" alt="">
        </div>
    </div>
  </div>
</div>
<div id="testimonials" class="container-fluid">
  <div class="container">
    <div class="row">
    	<div class="col-xs-12 message-icon-holder">
        	<div class="message-icon">
            	<div class="message-icon-body accent-color-bg">...</div>
                <div class="message-icon-arrow accent-color-border"></div>
            </div>
        </div>
        <div class="col-xs-12 testimonial-text-holder">
        	<div class="testimonial-text t1 accent-color-text">
            	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
            </div>
            <div class="testimonial-text t2 accent-color-text testimonial-text-hide">
            	<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
            </div>
            <div class="testimonial-text t3 accent-color-text testimonial-text-hide">
            	<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam,</p>
            </div>
            <div class="testimonial-text t4 accent-color-text testimonial-text-hide">
            	<p>nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
            </div>
            <div class="testimonial-text t5 accent-color-text testimonial-text-hide">
            	<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <div class="testimonial-text t6 accent-color-text testimonial-text-hide">
            	<p>sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam</p>
            </div>
        </div>
        <div class="col-xs-12">
        	 <div class="people-slider">
          		<div class="person-details person-details-show" data-num="1">
                	<div class="person-image-holder">
                		<img class="person-image" src="{{ asset('admin_assets/images/people/1.jpg') }}" alt="">
                    </div>
                    <div class="person-details-holder">
                    	<div class="person-name">Jane Doe</div>
                        <div class="person-title">Job Title</div>
                    </div>
                </div>
                <div class="person-details" data-num="2">
                	<div class="person-image-holder">
                		<img class="person-image" src="{{ asset('admin_assets/images/people/2.jpg') }}" alt="">
                    </div>
                    <div class="person-details-holder">
                    	<div class="person-name">Jane Doe</div>
                        <div class="person-title">Job Title</div>
                    </div>
                </div>
                <div class="person-details" data-num="3">
                	<div class="person-image-holder">
                		<img class="person-image" src="{{ asset('admin_assets/images/people/3.jpg') }}" alt="">
                    </div>
                    <div class="person-details-holder">
                    	<div class="person-name">Jane Doe</div>
                        <div class="person-title">Job Title</div>
                    </div>
                </div>
                <div class="person-details" data-num="4">
                	<div class="person-image-holder">
                		<img class="person-image" src="{{ asset('admin_assets/images/people/4.jpg') }}" alt="">
                    </div>
                    <div class="person-details-holder">
                    	<div class="person-name">Jane Doe</div>
                        <div class="person-title">Job Title</div>
                    </div>
                </div>
                <div class="person-details" data-num="5">
                	<div class="person-image-holder">
                		<img class="person-image" src="{{ asset('admin_assets/images/people/1.jpg') }}" alt="">
                    </div>
                    <div class="person-details-holder">
                    	<div class="person-name">Jane Doe</div>
                        <div class="person-title">Job Title</div>
                    </div>
                </div>
                <div class="person-details" data-num="6">
                	<div class="person-image-holder">
                		<img class="person-image" src="{{ asset('admin_assets/images/people/2.jpg') }}" alt="">
                    </div>
                    <div class="person-details-holder">
                    	<div class="person-name">Jane Doe</div>
                        <div class="person-title">Job Title</div>
                    </div>
                </div>
        	</div>
        </div>
    </div>
  </div>
</div>
<div id="contact" class="container-fluid accent-color-bg">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 row-title"></div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="sub-title">Location information</div>
        <p> No.66, 1st Floor,<br>
          19th Street, Shankarik Nagar,<br>
          Pammal, Chennai, CG – 600075<br>
          </p>
        <p>6309734245<br>
           info@productdemo.com<br>
         Hotline: 0987654321</p>
      </div>
      <div class="col-sm-4">
        <div class="sub-title">Sitemap</div>
          <a href="{{ url('') }}"><p>Home</p></a>
          <a href="{{ route('get:terms_conditions') }}"><p>Terms & Conditions</p></a>
          <a href="{{ route('get:seller_policy') }}"><p>Seller Policy</p></a>
          <a href="{{ route('get:faq_support') }}"><p>FAQ & Support</p></a>
        
      </div>
      <div class="col-md-4">
          <div class="sub-title">Download our seller apps from here</div>
          <img src="{{ asset('admin_assets/images/google-play.png') }}">
          <img src="{{ asset('admin_assets/images/app-store.png') }}">
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('admin_assets/js/jquery.min.js') }}"></script> 
<script src="{{ asset('admin_assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/modernizr-custom.js') }}"></script>
<script src="{{ asset('admin_assets/js/slick.min.js') }}"></script> 
<script src="{{ asset('admin_assets/js/createjs.min.js') }}"></script> 
<script src="{{ asset('admin_assets/js/logo.js') }}"></script>
<script src="{{ asset('admin_assets/js/main.js') }}"></script>
</body>
</html>
