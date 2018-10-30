<div class="page-product-box">
    <h3 class="heading">Related Products</h3>
    <ul class="product-list owl-carousel" data-dots="false" data-loop="false" data-nav="true"
        data-margin="30" data-autoplayTimeout="1000" data-autoplayHoverPause="true"
        data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":3}}'>
        @foreach($similarProducts as $similarProduct)
            <li>
                <div class="product-container">
                    <div class="left-block">
                        <a href="{{ route('get:product_detail', $similarProduct->slug) }}">
                            <img class="img-responsive" alt="product"
                                 src="{{ asset('300ProdctImg/'.$similarProduct->product_img) }}"/>
                        </a>
                        <div class="quick-view">
                            <a title="Add to my wishlist"
                               class="heart wishlist @if($similarProduct->isWishListProducts()) wishlisted @endif"
                               productId="{{ $similarProduct->id }}" href="javascript:void(0);"></a>
                            <a title="Add to compare"
                               class="compare compare-product @if($similarProduct->iscompareProducts()) wishlisted @endif "
                               productId="{{ $similarProduct->id }}" href="javascript:void(0);"></a>
                            <a title="Quick view" class="search" href="javascript:void(0);"
                               productId="{{ $similarProduct->id }}"></a>
                        </div>
                        <div class="add-to-cart">
                            <a title="Add to Cart" class="btn-add-cart" href="javascript:void(0);"
                               slug="{{ $similarProduct->slug }}">Add to Cart</a>
                        </div>
                    </div>
                    <div class="right-block">
                        <h5 class="product-name"><a
                                    href="{{ route('get:product_detail', $similarProduct->slug) }}">{{ $similarProduct->name }}</a>
                        </h5>
                        <div class="product-star">
                            <div class="ratiyo-rating" data-rating="{{ $similarProduct->getAvgRating() }}"></div>
                        </div>

                        <div class="content_price">
                            @if(count($similarProduct->getDiscountPrice())>0)
                                <span class="price product-price"><i class="fa fa-inr"></i>{{ $similarProduct->getDiscountPrice() }}</span>
                                <span class="price old-price"><i class="fa fa-inr"></i>{{ $similarProduct->price }}</span>
                            @else
                                <span class="price product-price"><i class="fa fa-inr"></i>{{ $similarProduct->price }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>