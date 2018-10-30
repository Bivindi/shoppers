<div class="row">
	<div class="col-12">
		<div class="filter row">
			<div class="col-8 col-md-3" style="margin-bottom: 15px;">
				<h6 class="result">Showing all {{ count($products)}} results</h6>
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
			<div class="col-sm-6 col-md-6 col-lg-4">
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