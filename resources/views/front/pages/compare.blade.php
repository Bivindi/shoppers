@extends('front.layout.default')
@section('title')
    Product
@endsection
@section('page-css')
<style>
    .container-radio input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}
.container-radio {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
}
</style>
@endsection
@section('body-class')
@endsection
@section('page-content')
<!-- =========================
        Product Details Section
    ============================== -->
    <section id="product-details">
    	<div class="container">
            <div class="row compare-folding-section">
                <div class="col-12 text-center">
                    <h2 class="compare-folding-title">Compare your Product</h2>
                    <div class="page-location pt-0">
                        <ul>
                            <li><a href="#">
                                Home <span class="divider">/</span>
                            </a></li>
                            <li><a href="#">
                                Shop <span class="divider">/</span>
                            </a></li>
                            <li><a class="page-location-active" href="#">
                                Proudct Compare
                                <span class="divider">/</span>
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
			<div class="row compare-products">
				<div class="col-12 p0">
                    <table class="col-md-12 p0 table table-responsive">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="choose-market text-center">
										<div class="compare-product-add">
											<i class="fa fa-hand-o-right" aria-hidden="true"></i>
											<h6 class="compare-product-tile">Compare product</h6>
											<p><u>5 products added</u></p>
										</div>
                                    </div>

                                </td>
                                @foreach($compareProducts as $compareProduct)
                                <td class="compare-details-section">
                                    <img src="{{ asset('300ProdctImg/'.$compareProduct->product_img) }}" class="figure-img img-fluid" alt="compare" style="max-height: 190px;height: 190px;">
                                    <div class="compare-price text-center product-detail-desktop">
                                        <h6 class="compare-details-title">{{ $compareProduct->name }}</h6>
                                        <div class="compare-details-price" style="    bottom: 0px;
    position: absolute;
    width: 100%;">
											<a href="{{ route('get:product_detail', $compareProduct->slug) }}" target="_blank" class="btn btn-primary btn-sm compare-details-btn">
                                                <div class="d-flex justify-content-between">
    												<p class="pull-left">Buy now</p>
    												
    												<p class="pull-right"><i class="fa fa-inr"></i>{{ $compareProduct->price }}</p>
                                                </div>
											</a>
										</div>
                                    </div>    
                                    
                                    
                                </td>
                                @endforeach
                                
                            </tr>
                            <tr>
                            				<td>Manufacturer</td>
                            				@foreach($compareProducts as $compareProduct)
                                                <td>{{ $compareProduct->getBrandName() }}</td>
                                            @endforeach
                            				
                            			</tr>
                            			<tr>
                            				<td>SKU</td>
                            				@foreach($compareProducts as $compareProduct)
                                                <td>{{ $compareProduct->sku }}</td>
                                            @endforeach
                            				
                            			</tr>
                            <tr>
                                <td>Availability</td>
                                @foreach($compareProducts as $compareProduct)
                            <td class="instock">@if($compareProduct->quantity != 0)Instock
                                ({{ $compareProduct->quantity }} items) @else Out of stock @endif
                            </td>
                        @endforeach
                            </tr>	
                            
                            <tr>
                                <td>Color</td>
                                @foreach($compareProducts as $product)
                                <td>
                                    @foreach($product->productColors() as $item)
                                    <label class="container-radio" for="{{ $item->desc }}">
                                                      <input type="radio" class="select-color" id="{{ $item->desc }}" name="color" value="{{ $item->desc }}">
                                                      <span class="checkmark" style="background-color: {{ $item->desc }}"></span>
                                    </label>
                                    @endforeach
                                </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Size</td>
                                @foreach($compareProducts as $product)
                                <td>
                                  @if(count($product->productSize())>0)
                                    @foreach($product->productSize() as $item)
                                        {{ $item->desc }} &nbsp;
                                    @endforeach
                                  @endif
                                </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Product Attributes</td>
                                @foreach($compareProducts as $product)
                                    <td>
                                        <table class="col-md-12 p0 table table-responsive">
                                        @foreach($product->productAttributes() as $item)
                                        <tr>
                                            <td>
                                                {{ $item->name}}
                                            </td>
                                            <td>
                                                {{ $item->desc }}
                                            </td>
                                        </tr>
                                           
                                        @endforeach
                                        </table>
                                    </td>
                        @endforeach
                            </tr>
                            
                        </tbody>
                    </table>
                    
				</div>
			</div>
			<div class="row related-product">
				<h4 class="related-product-title">Related Items</h4>
				<div id="related-product" class="owl-carousel owl-theme">
	    			<div class="col-12">
						<figure class="figure product-box">
							<div class="product-box-img">
                                <a href="product-details.html">
								    <img src="img/product-img/product-img-1.jpg" class="figure-img img-fluid" alt="Product Img">
                                </a>
							</div>
							<div class="quick-view-btn">
								<div class="compare-btn">
									<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg-product-1"><i class="fa fa-eye" aria-hidden="true"></i> Quick view</button>
								</div>
							</div>
							<figcaption class="figure-caption text-center">
								<span class="badge badge-secondary wd-badge text-uppercase">New</span>
								<div class="wishlist">
									<i class="fa fa-heart" aria-hidden="true"></i>
								</div>
								<div class="price-start">
									<p>Price start from   <strong class="active-color"><u>$80.00</u> - <u>$75.00</u></strong></p>
								</div>
								<div class="content-excerpt">
									<p><a href="#"></a>Cras in nunc non ipsum</p>
								</div>
								<div class="rating">
									<a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
									<a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
									<a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
									<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
									<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
								</div>
								<div class="compare-btn">
									<a class="btn btn-primary btn-sm" href="#"><i class="fa fa-exchange" aria-hidden="true"></i> Add to compare</a>
								</div>
							</figcaption>
						</figure>
	    			</div>
	    			<div class="col-12">
						<figure class="figure product-box">
							<div class="product-box-img">
                                <a href="product-details.html">
								    <img src="img/product-img/product-img-2.jpg" class="figure-img img-fluid" alt="Product Img">
                                </a>
							</div>
							<div class="quick-view-btn">
								<div class="compare-btn">
									<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg-product-1"><i class="fa fa-eye" aria-hidden="true"></i> Quick view</button>
								</div>
							</div>
							<figcaption class="figure-caption text-center">
								<span class="badge badge-secondary wd-badge text-uppercase">New</span>
								<div class="wishlist">
									<i class="fa fa-heart active-wishlist" aria-hidden="true"></i>
								</div>
								<div class="price-start">
									<p>Price start from   <strong class="active-color"><u>$80.00</u> - <u>$75.00</u></strong></p>
								</div>
								<div class="content-excerpt">
									 <p><a href="#">Cras in nunc non ipsum</a></p>
								</div>
								<div class="rating">
									<a class="active-color" href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
									<a class="active-color" href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
									<a class="active-color" href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
									<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
									<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
								</div>
								<div class="compare-btn">
									<a class="btn btn-primary btn-sm" href="#"><i class="fa fa-exchange" aria-hidden="true"></i> Add to compare</a>
								</div>
							</figcaption>
						</figure>
	    			</div>
	    			<div class="col-12">
						<figure class="figure product-box">
							<div class="product-box-img">
                                <a href="product-details.html">
								    <img src="img/product-img/product-img-3.jpg" class="figure-img img-fluid" alt="Product Img">
                                </a>
							</div>
							<div class="quick-view-btn">
								<div class="compare-btn">
									<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg-product-1"><i class="fa fa-eye" aria-hidden="true"></i> Quick view</button>
								</div>
							</div>
							<figcaption class="figure-caption text-center">
								<span class="badge badge-secondary wd-badge featured-bg-color text-uppercase">Featured</span>
								<div class="wishlist">
									<i class="fa fa-heart" aria-hidden="true"></i>
								</div>
								<div class="price-start">
									<p>Price start from   <strong class="active-color"><u>$80.00</u> - <u>$75.00</u></strong></p>
								</div>
								<div class="content-excerpt">
									 <p><a href="#">Cras in nunc non ipsum</a></p>
								</div>
								<div class="rating">
									<a class="active-color" href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
									<a class="active-color" href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
									<a class="active-color" href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
									<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
									<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
								</div>
								<div class="compare-btn">
									<a class="btn btn-primary btn-sm" href="#"><i class="fa fa-exchange" aria-hidden="true"></i> Add to compare</a>
								</div>
							</figcaption>
						</figure>
	    			</div>
	    			<div class="col-12">
						<figure class="figure product-box">
							<div class="product-box-img">
                                <a href="product-details.html">
								    <img src="img/product-img/product-img-4.jpg" class="figure-img img-fluid" alt="Product Img">
                                </a>
							</div>
							<div class="quick-view-btn">
								<div class="compare-btn">
									<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg-product-1"><i class="fa fa-eye" aria-hidden="true"></i> Quick view</button>
								</div>
							</div>
							<figcaption class="figure-caption text-center">
								<span class="badge badge-secondary wd-badge text-uppercase">New</span>
								<div class="wishlist">
									<i class="fa fa-heart" aria-hidden="true"></i>
								</div>
								<div class="price-start">
									<p>Price start from   <strong class="active-color"><u>$80.00</u> - <u>$75.00</u></strong></p>
								</div>
								<div class="content-excerpt">
									 <p><a href="#">Cras in nunc non ipsum</a></p>
								</div>
								<div class="rating">
									<a class="active-color" href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
									<a class="active-color" href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
									<a class="active-color" href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
									<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
									<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
								</div>
								<div class="compare-btn">
									<a class="btn btn-primary btn-sm" href="#"><i class="fa fa-exchange" aria-hidden="true"></i> Add to compare</a>
								</div>
							</figcaption>
						</figure>
	    			</div>
	    			<div class="col-12">
						<figure class="figure product-box">
							<div class="product-box-img">
                                <a href="product-details.html">
								    <img src="img/product-img/product-img-5.jpg" class="figure-img img-fluid" alt="Product Img">
                                </a>
							</div>
							<div class="quick-view-btn">
								<div class="compare-btn">
									<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg-product-1"><i class="fa fa-eye" aria-hidden="true"></i> Quick view</button>
								</div>
							</div>
							<figcaption class="figure-caption text-center">
								<span class="badge badge-secondary wd-badge text-uppercase">New</span>
								<div class="wishlist">
									<i class="fa fa-heart" aria-hidden="true"></i>
								</div>
								<div class="price-start">
									<p>Price start from   <strong class="active-color"><u>$80.00</u> - <u>$75.00</u></strong></p>
								</div>
								<div class="content-excerpt">
									 <p><a href="#">Cras in nunc non ipsum</a></p>
								</div>
								<div class="rating">
									<a class="active-color" href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
									<a class="active-color" href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
									<a class="active-color" href="#"><i class="fa fa-star" aria-hidden="true"></i></a>
									<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
									<a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
								</div>
								<div class="compare-btn">
									<a class="btn btn-primary btn-sm" href="#"><i class="fa fa-exchange" aria-hidden="true"></i> Add to compare</a>
								</div>
							</figcaption>
						</figure>
	    			</div>
				</div>
			</div>
    	</div>
    </section>
@endsection
@section('page-js')
@endsection