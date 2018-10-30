<li>
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
            <a title="Add to Cart" class="btn-add-cart"
               href="{{ route('get:product_detail', $product->slug) }}">Add to Cart</a>
        </div>
    </div>
    <div class="right-block">
        <h5 class="product-name">
            <a href="{{ route('get:product_detail', $product->slug) }}" title="{{ $product->name }}">{{ ucwords($product->name) }}</a>
            <div class="paragraph-end"></div>
        </h5>
        <div class="content_price">
            @if(count($product->getDiscountPrice())>0)
                <span class="price product-price"><i
                            class="fa fa-inr"></i>{{ $product->getDiscountPrice() }}</span>
                <span class="price old-price"><i
                            class="fa fa-inr"></i>{{ $product->price }}</span>
            @else
                <span class="price product-price"><i
                            class="fa fa-inr"></i>{{ $product->price }}</span>
            @endif
        </div>
    </div>
    <div class="price-percent-reduction2">
        - {{ round($product->percentage) }}% OFF
    </div>
</li>