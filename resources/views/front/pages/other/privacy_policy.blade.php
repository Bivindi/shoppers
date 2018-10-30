@extends('front.layout.default')
@section('title')
     Privacy Policy
@endsection

@section('metadescription')
     Privacy Policy
@endsection
@section('page-css')
@endsection

@section('page-content')
	
	<!-- =========================
        Slider Section
    ============================== -->
    <section class="wishlist-slider-section  wd-slider-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="text-center">
						<h1 class="wishlist-slider-title"> Privacy Policy</h1>
	                    <div class="page-location pt-0">
	                        <ul>
	                            <li><a href="{{ url('') }}">
	                                Home <span class="divider">/</span>
	                            </a></li>
	                            <li><a class="page-location-active" href="#">
	                                <span class="active-color"> Privacy Policy</span>
	                                <span class="divider">/</span>
	                            </a></li>
	                        </ul>
	                    </div>
                    </div>
				</div>
			</div>
		</div>
    </section>
	
	<section id="condition" style="background:#f5f5f5">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<br><br>
					<h3>PRIVACY POLICY</h3>
					<hr>
					@if(count($privacy)>0)
                        {!! $privacy->desc !!}
                    @endif
					
					<br><br>
				</div>
			</div>
		</div>
	</section>

@endsection
@section('page-js')
@endsection