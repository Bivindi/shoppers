@extends('front.layout.default')
@section('title')
    Homepage
@endsection

@section('metadescription')
    Homepage
@endsection
@section('page-css')
<style type="text/css">
	.slider-img
	{
		padding-right: 0px !important;
	}
</style>
@endsection

@section('page-content')
	<!-- =========================
        Slider Section
    ============================== -->
    <section id="main-slider-section">
        <div id="main-slider" class="slider-bg2  owl-carousel owl-theme product-review slider-cat">
        	@foreach($mainSliders as $mainSlider)
	            <div class="item d-flex  slider-bg align-items-center">
	                <div class="container-fluid">
	                    <div class="row justify-content-end">

	                        <!-- <div class="slider-text order-2 order-sm-1 col-sm-6  col-xl-4   col-md-6">
	                            <h6 class="sub-title">Choose your favourite market</h6>
	                            <h1 class="slider-title"><strong class="highlights-text">Compare</strong> Best Prices</h1>
	                            <p class="slider-content">Grabe it hurry.</p>
	                            <a href="shop-left-sidebar.html" class="btn btn-primary wd-shop-btn slider-btn">
									Go to store <i class="fa fa-arrow-right" aria-hidden="true"></i>
								</a>
	                        </div> -->
	                        <div class="col-sm-12 col-md-12  order-1 order-sm-2 col-xl-12 slider-img" >
	                            <img src="{{ asset('slider/'.$mainSlider->main_slider) }}" alt="{{ $mainSlider->main_slider }}">
	                        </div>
	                    </div>
	                </div>
	            </div>
	        @endforeach
        </div>
    </section>

    <!-- =========================
        Service Section
    ============================== -->
    <section id="wd-service">
        <div class="container-fluid custom-width">
            <div class="row">
                <div class="col-md-12 col-lg-4 col-xl-4 wow fadeIn animated" data-wow-delay="0.2s">
                    <ul class="list-unstyled">
                        <li class="media">
                            <img class="d-flex mr-3" src="{{ asset('front/img/compare-icon.png') }}" alt="compare-icon">
                            <div class="media-body">
                                <h5 class="wd-service-title mt-0 mb-1">Lets Compare</h5>
                                <p>Choose your product with price comparisons make your best deal today</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12 col-lg-4 col-xl-4 wow fadeIn animated" data-wow-delay="0.4s">
                    <ul class="list-unstyled">
                        <li class="media">
                            <img class="d-flex mr-3" src="{{ asset('front/img/review-icon.png') }}" alt="compare-icon">
                            <div class="media-body">
                                <h5 class="wd-service-title mt-0 mb-1">Take Review</h5>
                                <p>Choose your product with price comparisons make your best deal today</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12 col-lg-4 col-xl-4 wow fadeIn animated" data-wow-delay="0.6s">
                    <ul class="list-unstyled">
                        <li class="media">
                            <img class="d-flex mr-3" src="{{ asset('front/img/store-icon.png') }}" alt="compare-icon">
                            <div class="media-body">
                                <h5 class="wd-service-title mt-0 mb-1">Choose Multi-Vendor Store</h5>
                                <p>Choose your product with price comparisons make your best deal today</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================
        TOP SELLERS IN
    ============================== -->
    <section id="amazon-review">
        <div class="container-fluid custom-width">
            <div class="amazon-review-box-area">
                <div class="row m0 justify-content-center ">
                    <div class="col-md-12 p0 ">
                        <div class="amazon-review-title">
                            <h6>TOP SELLERS IN</h6>
                        </div>
                    </div>
                    @foreach($topSellerProducts as $product)
                    <div class="col-12 col-md-6 col-lg-4 p0 amazon-review-box wow fadeIn animated" data-wow-delay="0.2s">
                        <div class="media">
                            <div class="row">
                                <div class="col-sm-4 col-md-5">
                                    <img class="img-fluid" src="{{ asset('268ProductImg/'.$product->product_img) }}" alt="{{ $product->product_img }}">
                                </div>
                                <div class="col-sm-8 col-md-7 p0 d-flex align-items-center">
                                    <div class="amazon-review-box-content">
                                        <!-- <div class="rating">
                                            <a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
                                        </div> -->
                                        <h6 class="amazon-review-box-title">{{ ucwords($product->name) }}</h6>
                                        <!-- <p class="amazon-review-content">IMPRESSIVE SOUND QUALITY IS THE ULTIOAL &amp; assive noise isolating, NOT active noise cancellation(ANC).</p> -->
                                        <div class="price">
                                        	@if($product->getDiscountPrice() > 0)
                                            	<strong>
                                            		<i class="fa fa-inr"></i>{{ $product->getDiscountPrice() }} - 
                                            		<i class="fa fa-inr"></i>{{ $product->price }}
                                            	</strong>
                                            @else
                                            	<strong>
                                            		<i class="fa fa-inr"></i>{{ $product->price }}
                                            	</strong>
                                            @endif
                                        </div>
                                        <a href="{{ route('get:product_detail', $product->slug) }}" class="btn btn-primary amazon-details">Details <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- =========================
        RECOMMENDATION FOR YOU
    ============================== -->
    <section id="categories">
        <div class="container-fluid custom-width">
            <div class="row">
                <!-- <div class="col-12 col-md-6 col-lg-6 col-xl-4 wow fadeIn animated" data-wow-delay="300ms">
                    <div class="categories-big-box">
                        <div class="categories-title">
                            RECOMMENDATION FOR YOU
                        </div>
                        <div data-video="cBNBnpmyGM0" id="video">
                            <img class="figure-img img-fluid" src="{{ asset('front/img/2.jpg') }}" alt="Youtube Video">
                        </div>
                    </div>
                </div> -->

                @foreach($recommendProducts as $key => $product)
                	@if($key == 0)
		                <div class="col-12 col-md-12 col-lg-12 col-xl-4 wow fadeIn animated" data-wow-delay="1200ms">
		                    <div class="categories-big-box text-center">
		                        <div class="featured-img">
		                    		<a href="{{ route('get:product_detail', $product->slug) }}">
		                            	<img src="{{ asset('300ProdctImg/'.$product->product_img) }}" class="img-fluid" alt="{{ $product->product_img }}">
		                            </a>
		                        </div><br><br>
		                        <div class="featured-info">
		                            <h3 class="featured-product-title">
		    							{{ ucwords($product->name) }}
		    						</h3>
                                    <div class="rating">
                                        @for($i = 1;$i < 6;$i++)
                                            @if($i <= $product->getAvgRating())
                                                <a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
                                            @else
                                                <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                            @endif
                                        @endfor
                                    </div>
		                        </div>
		                    </div>
		                </div>
		            @elseif($key == 1 || $key == 2)
			            @if($key%2 != 0 )
		                	<div class="col-12 col-md-6 col-lg-6 col-xl-4">
		               	@endif
			                    <div class="categories-small-box wow fadeIn animated" data-wow-delay="900ms">
			                        <div class="container">
			                            <div class="row">
			                                <div class="col-md-12">
			                                    <div class="d-flex justify-content-start align-items-center">
			                                        <div class="categories-img align-items-center">
			                                        	<a href="{{ route('get:product_detail', $product->slug) }}">
			                                            	<img src="{{ asset('268ProductImg/'.$product->product_img) }}" class="img-fluid" alt="{{ $product->product_img }}">
			                                           	</a>
			                                        </div>
			                                        <div class="categories-info">
			                                            <!-- <h2 class="categories-name">{{ ucwords($product->name) }}</h2> -->
			                                            <p class="categories-content">{{ ucwords($product->name) }}</p>
			                                            <a href="{{ route('get:product_detail', $product->slug) }}" class="btn btn-primary wd-shop-btn">
															Shop now
														</a>

														<div class="d-flex justify-content-between">
						                            	
						                            </div>

			                                        </div>
			                                    </div>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			            @if($key%2 == 0 )
			                </div>
			            @endif
                    @else
                        <div class="col-12 col-md-12 col-lg-12 col-xl-4 wow fadeIn animated" data-wow-delay="1200ms">
                            <div class="categories-big-box text-center">
                                <div class="featured-img">
                                    <a href="{{ route('get:product_detail', $product->slug) }}">
                                        <img src="{{ asset('300ProdctImg/'.$product->product_img) }}" class="img-fluid" alt="{{ $product->product_img }}">
                                    </a>
                                </div><br><br>
                                <div class="featured-info">
                                    <h3 class="featured-product-title">
                                        {{ ucwords($product->name) }}
                                    </h3>
                                    <div class="rating">
                                        @for($i = 1;$i < 6;$i++)
                                            @if($i <= $product->getAvgRating())
                                                <a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
                                            @else
                                                <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
			        @endif
                @endforeach
            </div>
        </div>
    </section>

    <!-- =========================
        Big Message Section
    ============================== -->
    <section id="big-message">
        <div class="container-fluid custom-width">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-4 wow fadeInLeft animated" data-wow-delay="300ms">
                    <div class="message-box">
                        <div class="message-title">
                            Be a successful affiliate marketer using
                            <strong>Blurb</strong> theme
                        </div>
                        <div class="message-content">
                            Wondering what you should be blogging on? The content marketing report will show you the popular articles on your blog as
                        </div>
                    </div>
                    <div class="message-bar-chart">
                        <img src="{{ asset('front/img/message-bar-chart.png') }}" class="img-fluid" alt="message-bar-chart">
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-12 col-md-12 col-lg-7 wow fadeInRight animated" data-wow-delay="300ms">
                    <div class="big-message-img">
                        <img src="{{ asset('front/img/only-image.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================
        NEW ARRIVALS IN
    ============================== -->
    <section id="recent-product" class="recent-pro-2">
        <div class="container-fluid custom-width">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="recent-product-title">NEW ARRIVALS IN</h2>
                </div>
                @foreach($newArrivalsProducts as $product)
	                <div class="col-12 col-sm-6 col-md-4 col-lg-3 wow fadeIn animated" data-wow-delay="100ms">
	                    <div class="recent-product-box">
	                        <div class="recent-product-img">
	                            <a href="{{ route('get:product_detail', $product->slug) }}"><img src="{{ asset('268ProductImg/'.$product->product_img) }}" class="img-fluid" alt="{{ $product->product_img }}"></a>
	                            @if($product->getDiscountPrice()>0)
	                            	<span class="badge badge-secondary wd-badge text-uppercase">{{ $product->getDiscountPercentage() }}% OFF</span>
	                            @endif
	                            <div class="recent-product-info">
	                                <div class="d-flex justify-content-between">
	                                	@if($product->getDiscountPrice()>0)
		                                    <div class="recent-price">
		                                        <span class="price"><i class="fa fa-inr"></i>{{ $product->getDiscountPrice() }}</span> - <span class="old-price"><i class="fa fa-inr"></i>{{ $product->price }}</span>
		                                    </div>
		                                @else
		                                	<div class="recent-price">
		                                        <span class="price"><i class="fa fa-inr"></i>{{ $product->price }}</span>
		                                    </div>
		                                @endif
	                                   <!--  <div class="recente-product-categories">
	                                        Phones
	                                    </div> -->
	                                </div>
	                                <div class="recente-product-content">
	                                    {{ ucwords($product->name) }}
	                                </div>
	                                <div class="recent-product-meta-link">
	                                    <a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i><strong>{{ $product->getAvgRating() }}</strong></a>
	                                    <a href="#" class="wishlist-home-product" productId="{{ $product->id }}">
	                                    @if($product->isWishListProducts())
                                            <i class="fa fa-heart" aria-hidden="true"  style="color:#ff4a4a"></i>
                                        @else
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        @endif
	                                    </a>
	                                    <a href="#" class="compare compare-product" productId="{{ $product->id }}">
                                            @if($product->iscompareProducts())
                                                <i class="fa fa-signal" aria-hidden="true" style="color:#ff4a4a;"></i>
                                            @else
                                                <i class="fa fa-signal" aria-hidden="true"></i>
                                            @endif
                                        </a>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            @endforeach
                
            </div>
        </div>
    </section>

    <!-- =========================
        SPECIAL PRODUCTS
    ============================== -->
    <section id="recent-product" class="recent-pro-2">
        <div class="container-fluid custom-width">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="recent-product-title">SPECIAL PRODUCTS</h2>
                </div>
                @foreach($specialProducts as $product)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 wow fadeIn animated" data-wow-delay="100ms">
                        <div class="recent-product-box">
                            <div class="recent-product-img">
                                <a href="{{ route('get:product_detail', $product->slug) }}"><img src="{{ asset('268ProductImg/'.$product->product_img) }}" class="img-fluid" alt="{{ $product->product_img }}"></a>
                                @if($product->getDiscountPrice()>0)
                                    <span class="badge badge-secondary wd-badge text-uppercase">{{ $product->getDiscountPercentage() }}% OFF</span>
                                @endif
                                <div class="recent-product-info">
                                    <div class="d-flex justify-content-between">
                                        @if($product->getDiscountPrice()>0)
                                            <div class="recent-price">
                                                <span class="price"><i class="fa fa-inr"></i>{{ $product->getDiscountPrice() }}</span> - <span class="old-price"><i class="fa fa-inr"></i>{{ $product->price }}</span>
                                            </div>
                                        @else
                                            <div class="recent-price">
                                                <span class="price"><i class="fa fa-inr"></i>{{ $product->price }}</span>
                                            </div>
                                        @endif
                                       <!--  <div class="recente-product-categories">
                                            Phones
                                        </div> -->
                                    </div>
                                    <div class="recente-product-content">
                                        {{ ucwords($product->name) }}
                                    </div>
                                    <div class="recent-product-meta-link">
                                        <a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i><strong>{{ $product->getAvgRating() }}</strong></a>
                                        <a href="#" class="wishlist-home-product" productId="{{ $product->id }}">
                                        @if($product->isWishListProducts())
                                            <i class="fa fa-heart" aria-hidden="true"  style="color:#ff4a4a"></i>
                                        @else
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        @endif
                                        </a>
                                        <a href="#" class="compare compare-product" productId="{{ $product->id }}">
                                            @if($product->iscompareProducts())
                                                <i class="fa fa-signal" aria-hidden="true" style="color:#ff4a4a;"></i>
                                            @else
                                                <i class="fa fa-signal" aria-hidden="true"></i>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>
    </section>

    <!-- =========================
        Offer time Section
    ============================== -->
    <section id="offer-time">
        <div class="container-fluid custom-width">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 col-xl-6 wow fadeInLeft animated" data-wow-delay="300ms">
                    <div class="offer-time-box">
                        <div class="row">
                            <div class="col-sm-5 col-md-6">
                                <img src="{{ asset('front/img/nokia.jpg') }}" alt="offer img" class="offer-img">
                            </div>
                            <div class="col-sm-7 col-md-6 d-flex align-items-center">
                                <div class="offer-content">
                                    <p class="offer-brand-name">Phone 6670</p>
                                    <h2 class="offer-title">SALE 75% <span>OFF</span></h2>
                                    <p class="offer-price">At $199 - Only for today</p>
                                    <div class='countdown' data-date="2017-12-31"></div>
                                    <div class="offer-btn offer-btn-primary">
                                        <a href="#" class="btn btn-primary wd-shop-btn">
											Go to <img src="{{ asset('front/img/offer-ebay-btn.png') }}" alt="">
										</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12 col-xl-6 wow fadeInRight animated" data-wow-delay="300ms">
                    <div class="offer-time-box">
                        <div class="row">
                            <div class="col-sm-5 col-md-6">
                                <img src="{{ asset('front/img/iphon.jpg') }}" alt="offer img" class="offer-img">
                            </div>
                            <div class="col-sm-7 col-md-6 d-flex align-items-center">
                                <div class="offer-content">
                                    <p class="offer-brand-name">Visual 8</p>
                                    <h2 class="offer-title">SALE 75% <span>OFF</span></h2>
                                    <p class="offer-price">At $199 - Only for today</p>
                                    <div class='countdown' data-date="2017-12-31"></div>
                                    <div class="offer-btn offer-btn-green">
                                        <a href="#" class="btn btn-primary green-btn">
											Go to <img src="{{ asset('front/img/offer-ebay-btn.png') }}" alt="">
										</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================
        Blog Section
    ============================== -->
    <section id="wd-news">
        <div class="container-fluid custom-width">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="news-title">Weekly Top News</h2>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 wow fadeIn animated" data-wow-delay="300ms">
                    <div class="wd-news-box">
                        <figure class="figure">
                            <figcaption></figcaption>
                            <img src="{{ asset('front/img/blog/news-img-1.jpg') }}" class="figure-img img-fluid rounded" alt="news-img">
                            <div class="wd-news-info">
                                <div class="figure-caption"><a href="single-blog-with.html">ThemeIM provides best affiliate theme and templates like BLURB</a></div>
                                <p class="wd-news-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis esse eligendi consectetur dicta minus placeat natus tempora dignissim</p>
                                <a href="single-blog-with.html" class="badge badge-light wd-news-more-btn">Read More <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                            </div>
                            <span class="angle-right-to-left"></span>
                        </figure>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 wow fadeIn animated" data-wow-delay="600ms">
                    <div class="wd-news-box">
                        <figure class="figure">
                            <figcaption></figcaption>
                            <img src="{{ asset('front/img/blog/news-img-2.jpg') }}" class="figure-img img-fluid rounded" alt="news-img">
                            <div class="wd-news-info">
                                <div class="figure-caption"><a href="single-blog-with.html">Top 10 affiliate themes and templates you get from ThemeIM</a></div>
                                <p class="wd-news-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis esse eligendi consectetur dicta minus placeat natus tempora dignissim</p>
                                <a href="single-blog-with.html" class="badge badge-light wd-news-more-btn">Read More <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                            </div>
                            <span class="angle-left-to-right"></span>
                        </figure>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 wow fadeIn animated" data-wow-delay="900ms">
                    <div class="wd-news-box">
                        <figure class="figure">
                            <figcaption></figcaption>
                            <img src="{{ asset('front/img/blog/news-img-3.jpg') }}" class="figure-img img-fluid rounded" alt="news-img">
                            <div class="wd-news-info">
                                <div class="figure-caption"><a href="single-blog-with.html">Make pixel perfect design and development from ThemeIM</a></div>
                                <p class="wd-news-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis esse eligendi consectetur dicta minus placeat natus tempora dignissim</p>
                                <a href="single-blog-with.html" class="badge badge-light wd-news-more-btn">Read More <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                            </div>
                            <span class="angle-right-to-left"></span>
                        </figure>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3 wow fadeIn animated" data-wow-delay="1200ms">
                    <div class="wd-news-box">
                        <figure class="figure">
                            <figcaption></figcaption>
                            <img src="{{ asset('front/img/blog/news-img-4.jpg') }}" class="figure-img img-fluid rounded" alt="news-img">
                            <div class="wd-news-info">
                                <div class="figure-caption"><a href="single-blog-with.html">Best US top catagories affiliate product list from BLURB Theme</a></div>
                                <p class="wd-news-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis esse eligendi consectetur dicta minus placeat natus tempora dignissim</p>
                                <a href="single-blog-with.html" class="badge badge-light wd-news-more-btn">Read More <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                            </div>
                            <span class="angle-left-to-right"></span>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================
        Call To Action Section
    ============================== -->
    <section id="call-to-action" class=" wow fadeInUp animated" data-wow-delay="0ms">
        <div class="container-fluid custom-width">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6">
                    <h2 class="call-to-action-message">Affiliate with <span class="bold-font">BLURB</span> Theme &#38; Get Maximum
					Sell From Multivendor Store</h2>
                </div>
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="d-flex justify-content-center">
                        <div class="call-to-action-buy-now">
                            <a href="https://themeforest.net/item/blurb-price-comparison-affiliate-website-multivendor-store-and-product-review-html5-template/20880845" class="btn btn-primary wd-shop-btn">
								Purchase Theme
							</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================
       Partner Section
    ============================== -->
    <section id="partner" class="text-center">
        <div class="container-fluid custom-width">
            <div class="row">
                <div class="col-6 col-md-6 col-lg-4 col-xl-2 wow fadeIn animated" data-wow-delay="0ms">
                    <img src="{{ asset('front/img/partner/partner-img-1.jpg') }}" class="figure-img img-fluid" alt="partner-img">
                </div>
                <div class="col-6 col-md-6 col-lg-4 col-xl-2 wow fadeIn animated" data-wow-delay="300ms">
                    <img src="{{ asset('front/img/partner/partner-img-2.jpg') }}" class="figure-img img-fluid" alt="partner-img">
                </div>
                <div class="col-6 col-md-6 col-lg-4 col-xl-2 wow fadeIn animated" data-wow-delay="600ms">
                    <img src="{{ asset('front/img/partner/partner-img-3.jpg') }}" class="figure-img img-fluid" alt="partner-img">
                </div>
                <div class="col-6 col-md-6 col-lg-4 col-xl-2 wow fadeIn animated" data-wow-delay="900ms">
                    <img src="{{ asset('front/img/partner/partner-img-4.jpg') }}" class="figure-img img-fluid" alt="partner-img">
                </div>
                <div class="col-6 col-md-6 col-lg-4 col-xl-2 wow fadeIn animated" data-wow-delay="1200ms">
                    <img src="{{ asset('front/img/partner/partner-img-5.jpg') }}" class="figure-img img-fluid" alt="partner-img">
                </div>
                <div class="col-6 col-md-6 col-lg-4 col-xl-2 wow fadeIn animated" data-wow-delay="1400ms">
                    <img src="{{ asset('front/img/partner/partner-img-6.jpg') }}" class="figure-img img-fluid" alt="partner-img">
                </div>
            </div>
        </div>
    </section>
@endsection
@section('page-js')
<script type="text/javascript">
    $(document).on('click', '.wishlist-home-product', function (e) {
        e.preventDefault();
        var wishlist = $(this);
        // alert(wishlist);
        var productId = $(this).attr('productId');
        $.ajax({
            type: 'get',
            url: "{{ route('get:add_to_wishlist') }}",
            data: {productId: productId},
            beforeSend: function () {
                $(this).attr('disabled', true);
            },
            success: function (result) {
                if (result.success == true) {
                    $.notify(result.message, "success");
                    location.reload();
                }
                if (result.error == true) {
                    $.notify(result.message, "error");
                }
            }
        });
    });

    $(document).on('click', '.compare-product', function (e) {
        e.preventDefault();
        var productId = $(this).attr('productId');
        var compare = $(this);
        $.ajax({
            type: 'get',
            url: "{{ route('get:add_to_compare') }}",
            data: {productId: productId},
            beforeSend: function () {
                $(this).attr('disabled', true);
            },
            success: function (result) {
                if (result.success == true) {
                    // if (result.count != 0) {
                    //     showCompareBtn();
                    // } else {
                    //     $('.compare-filed').html('');
                    // }
                    // $.notify(result.message, "success");
                    // if (result.added == 1) {
                    //     compare.addClass('wishlisted');
                    //     compare.find('i').addClass('wishlisted-icon');
                    // } else {
                    //     compare.removeClass('wishlisted');
                    //     compare.find('i').removeClass('wishlisted-icon');
                    // }
                    $.notify(result.message, "success");
                    location.reload();
                }
                if (result.error == true) {
                    $.notify(result.message, "error");
                    compare.removeClass('wishlisted');
                    compare.find('i').removeClass('wishlisted-icon');
                }
            }
        });
    });
</script>
@endsection