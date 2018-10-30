@extends('front.layout.default')
@section('title')
    Whishlist
@endsection

@section('metadescription')
    Whishlist
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
    <section class="wishlist-slider-section  wd-slider-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="text-center">
						<h1 class="wishlist-slider-title">Wishlist</h1>
	                    <div class="page-location pt-0">
	                        <ul>
	                            <li><a href="{{ url('') }}">
	                                Home <span class="divider">/</span>
	                            </a></li>
	                            <li><a class="page-location-active" href="#">
	                                <span class="active-color">Wishlist</span>
	                                <span class="divider">/</span>
	                            </a></li>
	                        </ul>
	                    </div>
                    </div>
				</div>
			</div>
		</div>
    </section>

    <!-- =========================
        Product Details Section
    ============================== -->
    <section id="product-details" class="wishlist-table">
    	<div class="container">
			<div class="row compare-products">
				<div class="col-12 p0">
			        <div id="no-more-tables">

			            <table class="col-md-12 p0 table table-responsive">
						  <thead>
						    <tr class="wishlist-table-title">
						      <th class="text-center">Remove</th>
						      <th class="text-center">Image</th>
						      <th class="text-center">Product name</th>
						      <th class="text-center">Ratings</th>
						      <th class="text-center">Unit price</th>
						      <!-- <th class="text-center">Availability</th> -->
						      <th class="text-center">Availability</th>
						    </tr>
						  </thead>
			        		<tbody>
			        			@if(count($wishlists)>0)
				        			@foreach($wishlists as $product)
					        			<tr>
					        				<td class="text-center remove-icon">
					        					<div class="vertical-center">
					        						<a href="#" class="wishlist price" productId="{{ $product->id }}" style="right: unset!important;">
						        						<div class="close-icon">
						        							<i class="fa fa-times" aria-hidden="true"></i>
						        						</div>
					        						</a>
					        					</div>
					        				</td>
					        				<td class="text-center">
					        					<img src="{{ asset('100ProductImg/'.$product->product_img) }}" class="figure-img img-fluid" alt="Product">
					        				</td>
					        				<td class="text-center">
					        					<div class="vertical-center">
					        						<p>{{ $product->name }}</p>
						        				</div>
					        				</td>
					        				<td class="text-center">
					        					<div class="vertical-center">
					        						<div class="wishlist-ratings">
						        						<strong>{{ $product->getAvgRating1($product->id) }}</strong>
							        				</div>
													<div class="rating">
														@for($i = 1;$i < 6;$i++)
															@if($i <= $product->getAvgRating1($product->id))
																<a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
															@else
																<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
															@endif
														@endfor
													</div>
												</div>
					        				</td>
					        				<td class="text-center">
					        					<div class="vertical-center">
					        						<div class="wishlist-price">
					        							<p>₹ {{ $product->price }}</p>
					        						</div>
					        					</div>
					        				</td>
					        				<!-- <td class="text-center">
					        					<div class="vertical-center">
					        						<div class="green-color"><i class="fa fa-check" aria-hidden="true"></i> In stock</div>
					        					</div>
					        				</td> -->
					        				<td class="text-center">
					        					<div class="vertical-center">
													<a href="{{ route('get:product_detail', $product->slug) }}" class="btn btn-primary select-market-btn">
													    Go to store <i class="fa fa-arrow-right" aria-hidden="true"></i>
													</a>
												</div>
					        				</td>
					        			</tr>
				        			@endforeach
			        			@else
			        				<tr>
			        					<td colspan="6" style="text-align: center;">
			        						<img
                                        src="{{ asset('/') }}img/mywishlist-empty.png"><span
                                        class="_3Lk2d2">Empty Wishlist</span><span class="_3uF3Z6">You have no items in your wishlist. Start adding!</span>
			        					</td>
			        			@endif
			        		</tbody>
			        	</table>
			        </div>
				</div>
			</div>


			<div class="row wishlist-compare-products">
				<div class="col-12 p0">
			        <div id="no-more-tables1">
			            <table class="col-md-12 p0 table table-responsive">
						  <thead class="display-none-wishlist-title">
						    <tr class="wishlist-table-title">
						      <th class="text-center">Remove</th>
						      <th class="text-center">Image</th>
						      <th class="text-center">Product name</th>
						      <th class="text-center">Ratings</th>
						      <th class="text-center">Unit price</th>
						      <th class="text-center">Availability</th>
						    </tr>
						  </thead>
			        		<tbody>
			        			@if(count($wishlists)>0)
			        				@foreach($wishlists as $product)
					        			<tr>
					        				<td class="text-center remove-icon">
					        					<div class="vertical-center">
					        						<a href="#" class="wishlist price" productId="{{ $product->id }}" style="right: unset!important;">
						        						<div class="close-icon">
						        							<i class="fa fa-times" aria-hidden="true"></i>
						        						</div>
					        						</a>
					        					</div>
					        				</td>
					        				<td class="text-center">
					        					<img src="{{ asset('100ProductImg/'.$product->product_img) }}" class="figure-img img-fluid" alt="Product">
					        				</td>
					        				<td class="text-center">
					        					<div class="vertical-center">
					        						<p>{{ $product->name }}</p>
						        				</div>
					        				</td>
					        				<td class="text-center">
					        					<div class="vertical-center">
					        						<div class="wishlist-ratings">
						        						<strong>{{ $product->getAvgRating1($product->id) }}</strong>
							        				</div>
													<div class="rating">
														@for($i = 1;$i < 6;$i++)
															@if($i <= $product->getAvgRating1($product->id))
															<a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
															@else
																<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
															@endif
														@endfor
													</div>
												</div>
					        				</td>
					        				<td class="text-center">
					        					<div class="vertical-center">
					        						<div class="wishlist-price">
					        							<p>₹ {{ $product->price }}</p>
					        						</div>
					        					</div>
					        				</td>
					        				<!-- <td class="text-center">
					        					<div class="vertical-center">
					        						<div class="green-color"><i class="fa fa-check" aria-hidden="true"></i> In stock</div>
					        					</div>
					        				</td> -->
					        				<td class="text-center">
					        					<div class="vertical-center">
													<a href="{{ route('get:product_detail', $product->slug) }}" class="btn btn-primary select-market-btn">
													    Go to store <i class="fa fa-arrow-right" aria-hidden="true"></i>
													</a>
												</div>
					        				</td>
					        			</tr>
					        		@endforeach
				        		@else
			        				<tr>
			        					<td colspan="6" style="text-align: center;">
			        						<img
                                        src="{{ asset('/') }}img/mywishlist-empty.png"><span
                                        class="_3Lk2d2">Empty Wishlist</span><span class="_3uF3Z6">You have no items in your wishlist. Start adding!</span>
			        					</td>
			        			@endif
			        		</tbody>
			        	</table>
			        </div>
				</div>
			</div>


			@if(isset($recentViewsProducts) &&  count($recentViewsProducts)>0)
				<div class="row related-product">
					<h4 class="related-product-title">YOU RECENTLY VIEWS</h4>
					<div id="related-product" class="owl-carousel owl-theme">
						@foreach($recentViewsProducts as $product)
			    			<div class="col-12 col-md-12">
								<figure class="figure product-box">
									<div class="product-box-img">
										<img src="{{ asset('268ProductImg/'.$product->product_img) }}" class="figure-img img-fluid" alt="{{ $product->product_img }}">
									</div>
									<div class="quick-view-btn">
										<div class="compare-btn">
											<a class="btn btn-primary btn-sm" href="{{ route('get:product_detail', $product->slug) }}" title="{{ $product->name }}"><i class="fa fa-eye" aria-hidden="true"></i> Quick view</a>
										</div>
									</div>
									<figcaption class="figure-caption text-center">
										<!-- <span class="badge badge-secondary wd-badge text-uppercase">New</span> -->
										<div class="wishlist price" productId="{{ $product->id }}">
											@if($product->isWishListProducts())
												<i class="fa fa-heart" aria-hidden="true" style="color:#ff4a4a"></i>
											@else
												<i class="fa fa-heart" aria-hidden="true"></i>
											@endif

										</div>
										<div class="price-start">
											<p>Price start from   
												@if(count($product->getDiscountPrice())>0)
													<strong class="active-color"><u><i class="fa fa-inr"></i>{{ $product->getDiscountPrice() }}</u></strong>
												@else
													<strong class="active-color"><u><i class="fa fa-inr"></i>{{ $product->price }}</u></strong>
												@endif
											</p>
										</div>
										<div class="content-excerpt">
											<p>{{ ucwords($product->name) }}</p>
										</div>
											{{ $product->getAvgRating() }}
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
											<a class="btn btn-primary btn-sm" href="#"><i class="fa fa-exchange" aria-hidden="true"></i> Add to compare</a>
										</div>
									</figcaption>
								</figure>
			    			</div>
			    		@endforeach
					</div>
				</div>
			@endif
    	</div>
    </section>

@endsection
@section('page-js')
	<script>
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