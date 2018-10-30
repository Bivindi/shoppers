@if(count($products)>0)
    @foreach($products as $product)
        <li class="col-sx-12 col-sm-4">
            <div class="product-container">
                <div class="left-block">
                    <a href="{{ route('get:product_detail', $product->slug) }}">
                        <img class="img-responsive" alt="{{ $product->product_img }}"
                             src="{{ asset('300ProdctImg/'.$product->product_img) }}"/>
                    </a>
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
                    <h5 class="product-name"><a
                                href="{{ route('get:product_detail', $product->slug) }}">{{ $product->name }}</a>
                    </h5>
                    <div class="product-star">
                        <div class="ratiyo-rating"
                             data-rating="{{ $product->getAvgRating() }}"></div>
                    </div>
                    <div class="content_price">
                        @if(count($product->getDiscountPrice())>0)
                            <span class="price"><i
                                        class="fa fa-inr"></i>{{ $product->getDiscountPrice() }}</span>
                            <span class="old-price"><i
                                        class="fa fa-inr"></i>{{ $product->price }}</span>
                        @else
                            <span class="price"><i class="fa fa-inr"></i> {{ $product->price }}</span>
                        @endif
                    </div>
                    <div class="info-orther">
                        <p class="availability">Availability: <span>@if($product->quantity != 0)
                                    In stock @else Not In Stock @endif</span></p>
                        <div class="product-desc">
                            {!! mb_strimwidth($product->desc, 0, 100, '...') !!}
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
@else
    <li class="col-sm-12" style="min-height: 300px;">
        <h4 style="text-align: center">Product not found</h4>
    </li>
@endif
<script>
    $(".ratiyo-rating").each(function () {
        var rating = $(this).attr("data-rating");
        $(this).rateYo(
            {
                rating: rating,
                spacing: "2px",
                starWidth: "15px",
                fullStar: true,
                readOnly: true
            }
        );
    });
</script>