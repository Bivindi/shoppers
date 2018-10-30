<div class="page-product-box">
    <h3 class="heading">You recently Views</h3>
    <ul class="product-list owl-carousel" data-dots="false" data-loop="false" data-nav="true"
        data-margin="30" data-autoplayTimeout="1000" data-autoplayHoverPause="true"
        data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":3}}'>
        @if(isset($recentViewsProducts) &&  count($recentViewsProducts)>0)
            @foreach($recentViewsProducts as $product)
                <li>
                    <div class="product-container">
                        <div class="left-block">
                            <a href="{{ route('get:product_detail', $product->slug) }}"><img
                                        class="img-responsive" alt="{{ $product->product_img }}"
                                        src="{{ asset('268ProductImg/'.$product->product_img) }}"/></a>
                            <div class="quick-view">
                                <a title="Add to my wishlist"
                                   class="heart wishlist @if($product->isWishListProducts()) wishlisted @endif"
                                   productId="{{ $product->id }}" href="javascript:void(0);"></a>

                                <a title="Add to compare"
                                   class="compare compare-product @if($product->iscompareProducts()) wishlisted @endif "
                                   productId="{{ $product->id }}" href="javascript:void(0);"></a>
                                   
                                <a title="Quick view" class="search" href="javascript:void(0);"
                                   productId="{{ $product->id }}"></a>
                            </div>
                            <div class="add-to-cart">
                                <a title="Add to Cart" class="btn-add-cart" href="javascript:void(0);"
                                   slug="{{ $product->slug }}">Add to Cart</a>
                            </div>
                        </div>
                        <div class="right-block">
                            <h5 class="product-name">
                                <a href="{{ route('get:product_detail', $product->slug) }}" title="{{ $product->name }}">{{ ucwords($product->name) }}</a>
                                <div class="paragraph-end"></div>
                            </h5>
                            <div class="product-star">
                                <div class="ratiyo-rating" data-rating="{{ $product->getAvgRating() }}"></div>
                            </div>
                            <div class="content_price">
                                @if(count($product->getDiscountPrice())>0)
                                    <span class="price product-price"><i class="fa fa-inr"></i>{{ $product->getDiscountPrice() }}</span>
                                    <span class="price old-price"><i class="fa fa-inr"></i>{{ $product->price }}</span>
                                @else
                                    <span class="price product-price"><i class="fa fa-inr"></i>{{ $product->price }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
</div>