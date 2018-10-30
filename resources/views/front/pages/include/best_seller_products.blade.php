<div class="block left-module">
    <p class="title_block">BEST SELLERS</p>
    <div class="block_content">
        <div class="owl-carousel owl-best-sell" data-loop="true" data-nav="false" data-margin="0"
             data-autoplayTimeout="1000" data-autoplay="true" data-autoplayHoverPause="true"
             data-items="1">
            <ul class="products-block best-sell">
                @foreach($bestSellerProducts as $bestSellerProduct)
                    <li>
                        <div class="products-block-left">
                            <a href="{{ route('get:product_detail', $bestSellerProduct->slug) }}">
                                <img src="{{ asset('100ProductImg/'.$bestSellerProduct->product_img) }}"
                                     alt="SPECIAL PRODUCTS">
                            </a>
                        </div>
                        <div class="products-block-right">
                            <p class="product-name">
                                <a href="{{ route('get:product_detail', $bestSellerProduct->slug) }}">{{ $bestSellerProduct->name }}</a>
                            </p>
                            <p class="product-price"><i class="fa fa-inr"></i>{{ $bestSellerProduct->price }}</p>
                            <p class="product-star">
                            <div class="ratiyo-rating" data-rating="{{ $bestSellerProduct->getAvgRating() }}"></div>
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
            <ul class="products-block best-sell">
                @foreach($bestThreeSellerProducts as $product)
                    <li>
                        <div class="products-block-left">
                            <a href="{{ route('get:product_detail', $product->slug) }}">
                                <img src="{{ asset('100ProductImg/'.$product->product_img) }}"
                                     alt="SPECIAL PRODUCTS">
                            </a>
                        </div>
                        <div class="products-block-right">
                            <p class="product-name">
                                <a href="{{ route('get:product_detail', $product->slug) }}">{{ $product->name }}</a>
                            </p>
                            <p class="product-price"><i class="fa fa-inr"></i>{{ $product->price }}</p>
                            <p class="product-star">
                            <div class="ratiyo-rating" data-rating="{{ $product->getAvgRating() }}"></div>
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>