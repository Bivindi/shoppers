<div class="dropdown wd-compare-btn">
								  <button class="btn btn-secondary dropdown-toggle compare-btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <i class="fa fa-shopping-cart"></i>

								  </button>
								  <span class="count">9</span>
								  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
								  	<div class="wd-item-list">
								  	 @if(isset($cartDetails))
								  	    @foreach($cartDetails as $cartDetail)
									  	<div class="media">
											<img class="d-flex mr-3" src="{{ asset('productimg/'.$cartDetail->product_img) }}" alt="cart-img" style="width: 50px;height: 50px;">
											<div class="media-body">
												<h6 class="mt-0 list-group-title">Voyage Yoga Bag</h6>
												<div class="rating">
													<a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
													<a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
													<a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
													<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
													<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
												</div>
												<div class="cart-price">$59</div>
											</div>
										</div>
										@endforeach
									@else
									    <div class="media">
									        <div class="media-body">
												<h3 class="mt-0 list-group-title">No Item In Cart</h3>
											</div>	
									    
									    </div>
									@endif  	
									  	
									</div>
								  	<div class="media text-center">
										<a href="{{ route('get:order_page') }}" class="btn btn-primary go-compare-page">CHECKOUT 
										<i class="fa fa-arrow-right" aria-hidden="true"></i></a>
									</div>
								  </div>
					</div>