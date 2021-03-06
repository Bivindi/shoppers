@extends('front.layout.default')
@section('title')
    {{ $data }} Products
@endsection

@section('metadescription')
    {{ $data }} Products
@endsection
@section('page-css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.css">
<style type="text/css">
	.color_attribute {
	  visibility: hidden;
	}
	label {
	  cursor: pointer;
	}
	.color_attribute + label:before {
	  /*border: 1px solid #333;*/
	  content: "\00a0";
	  display: inline-block;
	  font: 16px/1em sans-serif;
	  height: 16px;
	  margin: 0 .25em 0 0;
	  padding: 0;
	  vertical-align: top;
	  width: 16px;
	}
	.color_attribute:checked + label:before {
	  background: #fff;
	  color: #333;
	  content: "\2713";
	  text-align: center;
	}
	.color_attribute:checked + label:after {
	  font-weight: bold;
	}

	.color_attribute:focus + label::before {
	    outline: rgb(59, 153, 252) auto 5px;
	}
</style>

@endsection

@section('page-content')
    <section id="product-amazon" class="product-shop-page product-shop-full-grid">
    	<div class="container">
    		<div class="row">
    			<div class="col-12 p0 ">
    				<div class="page-location">
    					<ul>
    						<li><a href="{{ url('') }}">
    							Home <span class="divider">/</span>
    						</a></li>
    						<li><a class="page-location-active" href="#">
    							{{ $data }}
    							<span class="divider">/</span>
    						</a></li>
    					</ul>
    				</div>
    			</div>
				<div class="order-2 order-md-2 col-12 col-md-4 col-lg-3 ">
				    <!-- =========================
				        Search Option
				    ============================== -->
				   <!--  <div class="sidebar-search">
						<div class="input-group wd-btn-group col-12 p0">
							<input type="text" class="form-control" placeholder="Search ..." aria-label="Search for...">
							<span class="input-group-btn">
								<button class="btn btn-secondary wd-btn-search" type="button">
									<i class="fa fa-search" aria-hidden="true"></i>
								</button>
							</span>
						</div>
					</div> -->

				    <!-- =========================
				        Category Option
				    ============================== -->
					<div class="side-bar category category-md">
						<h5 class="title">Category</h5>
						<ul class="dropdown-list-menu">
							@foreach($categories as $category)
								@if(count($category->subCategories()->get())>0)
									<li class="sidebar-dropdown">
								@else
									<li>
								@endif
								@if(count($category->subCategories()->get())>0)
									<p><i class="fa fa-angle-double-right" aria-hidden="true"></i> {{ $category->name }}</p>
								@else
									<a><i class="fa fa-angle-double-right" aria-hidden="true"></i> {{ $category->name }}</a>
								@endif
								@if(count($category->subCategories()->get())>0)
									<ul class="dropdown-sub-menu">
										@foreach($category->subCategories()->get() as $subCategory)
											<li><a href="{{ route('get:sub_category_products', ['cat' => $category->slug, 'subCatSlug' => $subCategory->slug]) }}"><i class="fa fa-angle-right" aria-hidden="true"></i> {{ $subCategory->name }}</a></li>
										@endforeach
									</ul>
								@endif
							</li>
							@endforeach
						</ul>
					</div>

					<div class="side-bar check-box">
						<h5 class="title">Price</h5>
						<div class="row">
							<div class="col-md-4" style="padding-right: 5px;padding-left: 0px">
								<input type="text" name="min" placeholder="$ min"  class="form-control min" >
							</div>
							<div class="col-md-4" style="padding-right: 0px;padding-left: 5px">
								<input type="text" name="max" placeholder="$ max" class="form-control max">
							</div>
							<input type="hidden" value="{{ $data }}" class="search_price">
							<div class="col-md-2">
								<button type="button" class="btn btn-default go">Go</button>
							</div>
						</div>

					</div>

					@if(count($productBrands)>0)
					<div class="side-bar check-box">
						<h5 class="title">Brand</h5>
						<ul>
							<form id="brandForm">
								@foreach($productBrands as $key => $productBrand)
									<li>
										<input type="checkbox" class="brand" id="brand{{$key}}" value="{{ $productBrand->brandId }}" name="brandId[]"/>
										<label for="brand{{ $key }}" class="select-brand">
											<span class="button"></span>
											{{ trim($productBrand->getBrandName()) }}
										</label>
										<input type="hidden" name="search" value="{{ $data }}" class="search_price">
									</li>
								@endforeach
							</form>
						</ul>
					</div>
					@endif

					@if(count($productSizes)>0)
					<div class="side-bar check-box">
						<h5 class="title">Size</h5>
						<ul>
							<form class="attrtibuteForm">
								
								@foreach($productSizes as $productSize)
									<li>
										<input type="checkbox" class="attribute" id="size{{ $key }}" value="{{$productSize['size']}}" name="attribute[]"/>
										<label for="size{{ $key }}" class="select-size">
											<span class="button"></span>{{ $productSize['size'] }}
										</label>
									</li>
								@endforeach
								<input type="hidden" name="search" value="{{ $data }}" class="search_price">
							</form>
						</ul>
					</div>
					@endif

					@if(count($productColors)>0)
						<div class="side-bar color-box">
							<h5 class="title">Color Option</h5>
							<form class="attrtibuteForm">
								<ul>
									
									@foreach($productColors as $key => $productColor)
									<li>
										<input type="checkbox" class="attribute color_attribute" id="color{{ $key }}" value="{{ $productColor['color'] }}" name="attribute[]"/>
										<label style=" background:{{ $productColor['color'] }};" for="color{{ $key }}">
											<span class="button"></span>
										</label>
									</li>
									@endforeach
									<input type="hidden" name="search" value="{{ $data }}" class="search_price">
								</ul>
							</form>
						</div>
					@endif

				    <!-- =========================
				        Special product
				    ============================== -->
				    @if(count($specialProduct)>0)
						<div class="side-bar tags-box" style="text-align: center;">
							<h5 class="title">SPECIAL PRODUCTS</h5>
							<div class="item">
                                <a href="{{ route('get:product_detail', $specialProduct->slug) }}">
                                    <img src="{{ asset('100ProductImg/'.$specialProduct->product_img) }}" class="figure-img img-fluid" alt="{{ $specialProduct->product_img }}">
                                </a>
								<div class="container">
									<div class="row">
										<div class="slider-text col-12 p0">
											<h5 class="product-price">
												@if(count($specialProduct->getDiscountPrice())>0)
						                            <span class="price">
						                            	<i class="fa fa-inr" style="font-size: 14px;"></i>{{ $specialProduct->getDiscountPrice() }}
						                            </span>
						                            <span class="old-price">
						                            	<i class="fa fa-inr"></i>{{ $specialProduct->price }}
						                            </span>
						                        @else
						                            <span class="price"><i class="fa fa-inr" style="font-size: 14px;"></i> {{ $specialProduct->price }}</span>
						                        @endif
											</h5>
											<p><a href="{{ route('get:product_detail', $specialProduct->slug) }}"
                                               title="{{ $specialProduct->name }}">{{ ucwords($specialProduct->name) }}</a></p>
											<div class="rating">
												@for($i = 1;$i < 6;$i++)
													@if($i <= $specialProduct->getAvgRating())
														<a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
													@else
														<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
													@endif
												@endfor
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endif

				    <!-- =========================
				        banner
				    ============================== -->

				    <div class="side-bar sidebar-review-box text-center">
						<!-- <h5 class="title">Average customer reviews</h5> -->
				    	<div class="sidebar-slider owl-carousel owl-theme product-review">
				    		@foreach($sidebarSliders as $sidebarSlider)
								<div class="item">
	                                <a href="#">
	                                    <img src="{{ asset('slider/'.$sidebarSlider->sidebar_slider) }}" class="figure-img img-fluid" alt="{{ $sidebarSlider->sidebar_slider }}">
	                                </a>
								</div>
							@endforeach
				    	</div>
					</div>

					<!-- =========================
				        On sale
				    ============================== -->
				    @if(count($onSellProducts) > 0)
					<div class="side-bar sidebar-review-box text-center">
						<h5 class="title">ON SALE</h5>
				    	<div class="sidebar-slider owl-carousel owl-theme product-review">
				    		@foreach($onSellProducts as $product)
								<div class="item">
	                                <a href="{{ route('get:product_detail', $product->slug) }}">
	                                    <img src="{{ asset('268ProductImg/'.$product->product_img) }}" class="figure-img img-fluid" alt="{{ $product->product_img }}">
	                                </a>
									<div class="container">
										<div class="row">
											<div class="slider-text col-12 p0">
												<h5 class="product-price">
													@if(count($specialProduct->getDiscountPrice())>0)
							                            <span class="price">
							                            	<i class="fa fa-inr" style="font-size: 14px;"></i>{{ $specialProduct->getDiscountPrice() }}
							                            </span>
							                            <span class="old-price">
							                            	<i class="fa fa-inr"></i>{{ $specialProduct->price }}
							                            </span>
							                        @else
							                            <span class="price"><i class="fa fa-inr" style="font-size: 14px;"></i> {{ $specialProduct->price }}</span>
							                        @endif
												</h5>
												<p><a href="{{ route('get:product_detail', $product->slug) }}" title="{{ $product->name }}">{{ ucwords($product->name) }}</a></p>
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
								</div>
							@endforeach
							
				    	</div>
					</div>
					@endif

					
				</div>
				<div class="order-1 order-md-1 col-12 col-md-8 col-lg-9 product-grid product-list">
					<div class="row">
						<div class="col-12">
							<div class="filter row">
								<div class="col-8 col-md-3" style="margin-bottom: 15px;">
									<h6 class="result">Showing all {{ count($data)}} results</h6>
								</div>
								<div class="col-6 col-md-6 filter-btn-area text-center">
									 <!-- <div class="btn-group" role="group">
									 	<div class="d-flex">
										 	<p>Sort by:</p>
										    <button id="btnGroupDropwdshowingres" type="button" class="btn btn-secondary dropdown-toggle filter-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										      Default
										    </button>
										    <div class="dropdown-menu" aria-labelledby="btnGroupDropwdshowingres">
										      <a class="dropdown-item" href="#">Camara</a>
										      <a class="dropdown-item" href="#">Joystick</a>
										    </div>
									    </div>
									  </div> -->
								</div>
								<div class="col-4 col-md-3 sorting text-right">
									<h6>Search: {{ $data }}</h6>
									<!-- <a href="shop-left-sidebar-full-grid.html">
										<i class="fa fa-bars" aria-hidden="true"></i>
									</a>
									<a href="shop-left-sidebar.html">
										<i class="fa fa-th active-color" aria-hidden="true"></i>
									</a> -->
								</div>
							</div>
						</div>
						<!-- <div class="owl-carousel"> -->
						<!-- <div class="product-list"> -->
			    			@foreach($products as $product)
				    			<div class="col-sm-6 col-md-6 col-lg-4 reviews-load-more">
									<figure class="figure product-box row">
										<div class="col-12 col-md-12 col-lg-12 col-xl-12 p0">
											<div class="product-box-img">
				                                <a href="{{ route('get:product_detail', $product->slug) }}">
				                                    <img src="{{ asset('268ProductImg/'.$product->product_img) }}" class="figure-img img-fluid" alt="{{ $product->product_img }}">
				                                </a>
											</div>
											<div class="quick-view-btn">
												<div class="compare-btn">
													<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg-product-1"><i class="fa fa-eye" aria-hidden="true"></i> Quick view</button>
												</div>
											</div>
												<!-- <span class="badge badge-secondary wd-badge text-uppercase">New</span> -->
												<div class="wishlist price" productId="{{ $product->id }}">
													@if($product->isWishListProducts())
														<i class="fa fa-heart active-wishlist" aria-hidden="true"></i>
													@else
														<i class="fa fa-heart" aria-hidden="true"></i>
													@endif
												</div>
										</div>
										<div class="col-12 col-md-12 col-lg-12 col-xl-12 p0">
											<div class="figure-caption text-center">
												<div class="price-start">
													<p>Price start from <strong class="active-color">
													 @if(count($product->getDiscountPrice())>0)
		                                                    <span class="price">
		                                                    	<i class="fa fa-inr" style="font-size: 14px;"></i>{{ $product->getDiscountPrice() }}
		                                                    </span>
		                                                    <span class="old-price">
		                                                    	<i class="fa fa-inr"></i>{{ $product->price }}
		                                                    </span>
		                                                @else
		                                                    <span class="price"><i class="fa fa-inr" style="font-size: 14px;"></i> {{ $product->price }}</span>
		                                                @endif
		                                            </strong></p>
												</div>
												<div class="content-excerpt">
													<p>{{ mb_strimwidth($product->name, 0, 50, '...') }}</p>
												</div>
												<div class="rating">
													@for($i = 1;$i < 6;$i++)
														@if($i <= $product->getAvgRating())
															<a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
														@else
															<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
														@endif
													@endfor
													
												</div>
												<div class="compare-btn">
													<a class="btn btn-primary btn-sm" href="{{ route('get:product_detail', $product->slug) }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart</a>
												</div>
											</div>
										</div>
									</figure>
				    			</div>
							@endforeach
						<!-- </div> -->
		    		
		    			<!-- <div class="col-12 text-center">
							<a href="#" id="loadMore" class="btn btn-primary wd-shop-btn">
								Show more
							</a>
		    			</div> -->
	    			</div>
				</div>
				
			</div>
    	</div>
    </section>

@endsection
@section('page-js')
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/bootstrap-slider.js"></script>
	<script>

		
        $('.go').on('click',function(){
        	$.ajax({
                type: 'get',
                url: "{{ route('get:price_range_products_serach_form') }}",
                data: {
                		min: $('.min').val(),
                		max: $('.max').val(),
                		search: $('.search_price').val(),
                	},
                success: function (result) {
                    $('.product-list').html(result);
                }
            });
        });

        $(document).on('change', '.attribute', function (e) {
            e.preventDefault();
            var $this = $(this);
            $.ajax({
                type: 'get',
                url: "{{ route('get:attribute_products_serach_form') }}",
                data: $('.attrtibuteForm').serialize(),
                success: function (result) {
                    $('.product-list').html(result);
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            });
        });

        $(document).on('change', '.brand', function (e) {
            e.preventDefault();
            console.log($('#brandForm').serialize());
            var $this = $(this);
            $.ajax({
                type: 'get',
                url: "{{ route('get:brand_products_serach_form') }}",
                data: $('#brandForm').serialize(),
                success: function (result) {
                    $('.product-list').html(result);
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            });
        });

        $(document).on('click', '.wishlist', function (e) {
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
                        location.reload();
                    }
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            });
        });
    </script>

@endsection