<div class="box-products top-sellers">
    <div class="container" style="background: #fff;padding: 0.5%;box-shadow: 0px 1px 2px 3px #00000040;">
        <div class="box-product-head">
            <span class="box-title">TOP SELLERS IN</span>
            <ul class="box-tabs nav-tab seller-nav" id="cat_top_sellers">
                <li class="active"><a href="javascript:void(0);" class="top-seller-product" catId="all">All</a></li>
                @foreach($topSellerCategories as $category)
                    <li><a href="javascript:void(0);" class="top-seller-product"
                           catId="{{ $category->id }}">{{ ucfirst($category->name) }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="box-product-content">
            @if(count($topSellerSliders)>0)
                <div class="box-product-adv">
                    <ul class="owl-carousel nav-center" data-items="1" data-dots="false" data-autoplay="true"
                        data-loop="true" data-nav="true">
                        @foreach($topSellerSliders as $sellerSlider)
                            <li><a href="{{ $sellerSlider->url }}"><img src="{{ asset('slider/'.$sellerSlider->top_seller_slider) }}" alt="{{ $sellerSlider->top_seller_slider }}"></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="box-product-list">
                <div class="tab-container">
                    <div class="tab-panel sellerProductTab active">
                        <ul class="product-list owl-carousel nav-center" data-dots="false" data-loop="true"
                            data-nav="true" data-margin="10"
                            data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                            @foreach($topSellerProducts as $product)
                                @include('front.pages.product.homepage_products')
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    
    @media only screen and (max-width: 480px) {
    #cat_top_sellers {
        display:none;
    }
}
</style>
</style>