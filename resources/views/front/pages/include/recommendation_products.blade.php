<style>
    
    @media only screen and (max-width: 480px) {
    #cat_recom {
        display:none;
    }
}
</style>
<div class="box-products recommendation">
    <div class="container" style="background: #fff;padding: 0.5%;box-shadow: 0px 1px 2px 3px #00000040;">
        <div class="box-product-head">
            <span class="box-title">RECOMMENDATION FOR YOU</span>
            <ul class="box-tabs nav-tab" id="cat_recom">
                <li class="active"><a class="recommend-product" type="recommend" catId="all" href="javascript:void(0);">All</a>
                </li>
                @foreach($recommendCategories as $category)
                    <li><a class="recommend-product" type="recommend" catId="{{ $category->id }}"
                           href="javascript:void(0);">{{ ucfirst($category->name) }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="box-product-content">
            @if(count($recommendSliders)>0)
                <div class="box-product-adv">
                    <ul class="owl-carousel nav-center" data-items="1" data-dots="false" data-autoplay="true"
                        data-loop="true" data-nav="true">
                        @foreach($recommendSliders as $recommendSlider)
                            <li><a href="{{ $recommendSlider->url }}"><img src="{{ asset('slider/'.$recommendSlider->recommend_slider) }}" alt="{{ $recommendSlider->recommend_slider }}"></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="box-product-list">
                <div class="tab-container">
                    <div class="tab-panel recommendProducts active">
                        <ul class="product-list owl-carousel nav-center" data-dots="false" data-loop="true"
                            data-nav="true" data-margin="10"
                            data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                            @foreach($recommendProducts as $product)
                                @include('front.pages.product.homepage_products')
                            @endforeach
                        </ul>
                    </div>
                    <div id="tab-8" class="tab-panel">
                        <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav="true"
                            data-margin="10"
                            data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                            <li>
                                <div class="left-block">
                                    <a href="#"><img class="img-responsive" alt="product"
                                                     src="{{ asset('front/') }}/assets/data/option4/p35.jpg"/></a>
                                    <div class="quick-view">
                                        <a title="Add to my wishlist" class="heart" href="#"></a>
                                        <a title="Add to compare" class="compare" href="#"></a>
                                        <a title="Quick view" class="search" href="#"></a>
                                    </div>
                                    <div class="add-to-cart">
                                        <a title="Add to Cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="#">Luxury Perfume</a></h5>
                                    <div class="content_price">
                                        <span class="price product-price">$38,95</span>
                                        <span class="price old-price">$52,00</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="left-block">
                                    <a href="#"><img class="img-responsive" alt="product"
                                                     src="{{ asset('front/') }}/assets/data/option4/p36.jpg"/></a>
                                    <div class="quick-view">
                                        <a title="Add to my wishlist" class="heart" href="#"></a>
                                        <a title="Add to compare" class="compare" href="#"></a>
                                        <a title="Quick view" class="search" href="#"></a>
                                    </div>
                                    <div class="add-to-cart">
                                        <a title="Add to Cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="#">Blue Diamond Ring</a></h5>
                                    <div class="content_price">
                                        <span class="price product-price">$38,95</span>
                                    </div>
                                </div>
                                <div class="price-percent-reduction2">
                                    -30% OFF
                                </div>
                            </li>
                            <li>
                                <div class="left-block">
                                    <a href="#"><img class="img-responsive" alt="product"
                                                     src="{{ asset('front/') }}/assets/data/option4/p37.jpg"/></a>
                                    <div class="quick-view">
                                        <a title="Add to my wishlist" class="heart" href="#"></a>
                                        <a title="Add to compare" class="compare" href="#"></a>
                                        <a title="Quick view" class="search" href="#"></a>
                                    </div>
                                    <div class="add-to-cart">
                                        <a title="Add to Cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="#">Superior Bag</a></h5>
                                    <div class="content_price">
                                        <span class="price product-price">$38,95</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="left-block">
                                    <a href="#"><img class="img-responsive" alt="product"
                                                     src="{{ asset('front/') }}/assets/data/option4/p38.jpg"/></a>
                                    <div class="quick-view">
                                        <a title="Add to my wishlist" class="heart" href="#"></a>
                                        <a title="Add to compare" class="compare" href="#"></a>
                                        <a title="Quick view" class="search" href="#"></a>
                                    </div>
                                    <div class="add-to-cart">
                                        <a title="Add to Cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="#">Luxury Lady</a></h5>
                                    <div class="content_price">
                                        <span class="price product-price">$38,95</span>
                                        <span class="price old-price">$52,00</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="left-block">
                                    <a href="#"><img class="img-responsive" alt="product"
                                                     src="{{ asset('front/') }}/assets/data/option4/p39.jpg"/></a>
                                    <div class="quick-view">
                                        <a title="Add to my wishlist" class="heart" href="#"></a>
                                        <a title="Add to compare" class="compare" href="#"></a>
                                        <a title="Quick view" class="search" href="#"></a>
                                    </div>
                                    <div class="add-to-cart">
                                        <a title="Add to Cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="#">Smart Phone</a></h5>
                                    <div class="content_price">
                                        <span class="price product-price">$38,95</span>
                                        <span class="price old-price">$52,00</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>