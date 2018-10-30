<div class="block left-module">
    <p class="title_block">ON SALE</p>
    <div class="block_content product-onsale">
        <ul class="product-list owl-carousel" data-loop="true" data-nav="false" data-margin="0"
            data-autoplayTimeout="1000" data-autoplayHoverPause="true" data-items="1" data-autoplay="true">
            @foreach($onSellProducts as $product)
                <li>
                    <div class="product-container">
                        <div class="left-block">
                            <a href="{{ route('get:product_detail', $product->slug) }}"><img
                                        class="img-responsive" alt="{{ $product->product_img }}"
                                        src="{{ asset('268ProductImg/'.$product->product_img) }}"/></a>
                            <div class="price-percent-reduction2">- {{ round($product->percentage) }}% OFF</div>
                        </div>
                        <div class="right-block">
                            <h5 class="product-name">
                                <a href="{{ route('get:product_detail', $product->slug) }}"
                                   title="{{ $product->name }}">{{ ucwords($product->name) }}</a>
                                <div class="paragraph-end"></div>
                            </h5>
                            <div class="product-star">
                                <div class="ratiyo-rating" data-rating="{{ $product->getAvgRating() }}"></div>
                            </div>
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
                        <div class="product-bottom">
                            <a title="Add to Cart" class="add-cart"
                               href="javascript:void(0);"
                               slug="{{ $product->slug }}">Add to Cart</a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>