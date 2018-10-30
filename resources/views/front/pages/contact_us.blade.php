@extends('front.layout.default')
@section('title')
    Contact us
@endsection

@section('metadescription')
    Contact us
@endsection
@section('page-css')
@endsection

@section('page-content')

	<!-- =========================
        Contact from Section
    ============================== -->
	<section id="contact-us">
	    <div class="container">
	    	<div class="row">
				<div class="col-12 p0">
					<div class="page-location">
						<ul>
							<li><a href="{{ url('') }}">
								Home<span class="divider">/</span>
							</a></li>
							<li><a class="page-location-active" href="#">
								Contact Us
								<span class="divider">/</span>
							</a></li>
						</ul>
					</div>
				</div>
	    	</div>
	    	<div class="contact-us-content">
		        <div class="row">
					<div class="col-md-12">
						<div id="map"></div>
					</div>
		        </div>
				<div class="row">
					<div class="col-12 col-md-6 col-lg-9 col-xl-9">
						<div class="contact-from">
							<div class="contact-description">
								<h4 class="contact-description-title">Tell us about yourself</h4>
								<p class="contact-description-content">Your email address will not be published. Required fields are marked *</p>
							</div>
							<form id="formValidate" action="{{ route('post:contact_us') }}" method="post">
                            {{ csrf_field() }}
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="inputEmail1" class="col-form-label">Subject Heading</label>
										<input type="text" name="subject" class="form-control input-sm" placeholder="Subject"/>
										<!-- <input type="text" class="form-control" id="inputEmail1" placeholder="Name"> -->
									</div>
									<div class="form-group col-md-6">
										<label for="inputEmail4" class="col-form-label">Email</label>
										<input type="email" name="email" class="form-control input-sm" id="email" placeholder="Email"/>
                                    	<span class="error">{{ $errors->first('email') }}</span>
									</div>
									<div class="form-group col-md-12">
										<label for="inputEmail4" class="col-form-label">Order reference</label>
										<input type="text" name="order_reference" class="form-control input-sm" id="order_reference" placeholder="Order reference" />
									</div>
									<div class="form-group col-md-12">
										<label for="exampleFormControlTextarea1" class="col-form-label">Your Message</label>
										<textarea class="form-control" id="exampleFormControlTextarea1" name="message" id="message"></textarea>
										<span class="error">{{ $errors->first('message') }}</span>
									</div>
								</div>
								<button type="submit" class="btn btn-primary wd-contact-btn">Submit</button>
							</form>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-3 col-xl-3">
						<div class="contact-address-area">
							<h4 class="contact-address-title">Address</h4>
							<p class="contact-address-content">Your email address will not be published.
							Required fields are marked *</p>
							<div class="contact-address">
								<div class="media radius-icon-area">
									<div class="radius-icon">
										<i class="fa fa-map-marker" aria-hidden="true"></i>
									</div>
									<div class="media-body radius-content">
										301 - Rivera Wave, Kalawad road, Rajkot, Gujarat - 360001
									</div>
								</div>
								<div class="media radius-icon-area">
									<div class="radius-icon">
										<i class="fa fa-phone" aria-hidden="true"></i>
									</div>
									<div class="media-body radius-content">
										<p><a href="tel:+09-987654321">+ 09-987654321</a></p>
										<p><a href="tel:+09-123456789">+ 09-123456789</a></p>
									</div>
								</div>
								<div class="media radius-icon-area">
									<div class="radius-icon">
										<i class="fa fa-envelope" aria-hidden="true"></i>
									</div>
									<div class="media-body radius-content">
										<p><a href="mailto:info@ productdemo.info">info@ productdemo.info</a></p>
										<p><a href="mailto:badhon@gmail.com">support@themeim.com</a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	    </div>
	</section>

@endsection
@section('page-js')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmzsVKw7vAfVti9uhVHCuxrUMUEFVH4Ng"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.min.js') }}"></script>
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

       // When the window has finished loading create our google map below
        google.maps.event.addDomListener(window, 'load', init);

        function init() {
            // Basic options for a simple Google Map
            // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            var mapOptions = {
                // How zoomed in you want the map to start at (always required)
                zoom: 18,
                scrollwheel: false,

                // The latitude and longitude to center the map (always required)
                center: new google.maps.LatLng(23.780276,  90.41671199999996), // New York

                // How you would like to style the map.
                // This is where you would paste any style found on Snazzy Maps.
                styles: [{ "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{ "color": "#444444" }] }, { "featureType": "administrative.locality", "elementType": "labels.text", "stylers": [{ "visibility": "on" }] }, { "featureType": "administrative.neighborhood", "elementType": "labels.text", "stylers": [{ "visibility": "off" }] }, { "featureType": "landscape", "elementType": "all", "stylers": [{ "color": "#e1e1e1" }, { "saturation": "0" }] }, { "featureType": "poi", "elementType": "geometry.fill", "stylers": [{ "color": "#d1d1d1" }] }, { "featureType": "poi.attraction", "elementType": "geometry.fill", "stylers": [{ "visibility": "off" }, { "color": "#d1d1d1" }] }, { "featureType": "poi.attraction", "elementType": "labels.text", "stylers": [{ "visibility": "on" }] }, { "featureType": "poi.business", "elementType": "geometry.fill", "stylers": [{ "saturation": "-3" }, { "lightness": "-4" }, { "gamma": "4.82" }, { "weight": "1.39" }, { "visibility": "off" }] }, { "featureType": "poi.business", "elementType": "labels.text", "stylers": [{ "visibility": "off" }] }, { "featureType": "poi.business", "elementType": "labels.icon", "stylers": [{ "visibility": "off" }] }, { "featureType": "poi.government", "elementType": "geometry.fill", "stylers": [{ "color": "#d1d1d1" }, { "visibility": "off" }] }, { "featureType": "poi.medical", "elementType": "geometry.fill", "stylers": [{ "visibility": "off" }, { "color": "#d1d1d1" }] }, { "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [{ "visibility": "on" }, { "color": "#ebebeb" }] }, { "featureType": "poi.park", "elementType": "labels", "stylers": [{ "visibility": "on" }] }, { "featureType": "poi.place_of_worship", "elementType": "geometry.fill", "stylers": [{ "visibility": "on" }, { "color": "#d1d1d1" }] }, { "featureType": "poi.school", "elementType": "geometry.fill", "stylers": [{ "color": "#d1d1d1" }, { "visibility": "off" }] }, { "featureType": "poi.sports_complex", "elementType": "geometry.fill", "stylers": [{ "visibility": "on" }, { "color": "#d1d1d1" }] }, { "featureType": "road", "elementType": "all", "stylers": [{ "saturation": -100 }, { "lightness": 45 }] }, { "featureType": "road", "elementType": "labels.text.fill", "stylers": [{ "color": "#333333" }] }, { "featureType": "road.highway", "elementType": "geometry.fill", "stylers": [{ "color": "#ffffff" }, { "visibility": "on" }] }, { "featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{ "visibility": "off" }] }, { "featureType": "road.highway", "elementType": "labels", "stylers": [{ "visibility": "off" }] }, { "featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{ "visibility": "off" }] }, { "featureType": "road.local", "elementType": "geometry.fill", "stylers": [{ "saturation": "6" }, { "hue": "#ff0000" }, { "visibility": "on" }] }, { "featureType": "transit", "elementType": "all", "stylers": [{ "visibility": "off" }] }, { "featureType": "transit", "elementType": "labels", "stylers": [{ "visibility": "on" }] }, { "featureType": "transit", "elementType": "labels.text.fill", "stylers": [{ "color": "#333333" }] }, { "featureType": "water", "elementType": "all", "stylers": [{ "color": "#00667d" }, { "visibility": "on" }] }, { "featureType": "water", "elementType": "geometry.fill", "stylers": [{ "color": "#cecece" }] }, { "featureType": "water", "elementType": "labels.text.fill", "stylers": [{ "color": "#ffffff" }] }, { "featureType": "water", "elementType": "labels.text.stroke", "stylers": [{ "visibility": "off" }] }]
            };

            // Get the HTML DOM element that will contain your map
            // We are using a div with id="map" seen below in the <body>
            var mapElement = document.getElementById('map');

            // Create the Google Map using our element and options defined above
            var map = new google.maps.Map(mapElement, mapOptions);

            // Let's also add a marker while we're at it
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(23.780276, 90.41671199999996),
                map: map,
                title: 'Wd It Solution',
                icon: 'img/marker.png'
            });
        }
    </script>
@endsection