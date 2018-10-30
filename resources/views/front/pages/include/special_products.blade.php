<div class="box-products special-products">
    <div class="container" style="background: #fff;padding: 0.5%;box-shadow: 0px 1px 2px 3px #00000040;">
        <div class="box-product-head">
            <span class="box-title">SPECIAL PRODUCTS</span>
            <ul class="box-tabs nav-tab" id="cat_special_product">
                <li class="active"><a class="special-product" type="special" catId="all"
                                      href="javascript:void(0);">All</a></li>
                @foreach($specialCategories as $category)
                    <li><a class="special-product" type="special" catId="{{ $category->id }}"
                           href="javascript:void(0);">{{ ucfirst($category->name) }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="box-product-content">
            @if(count($specialSliders)>0)
                <div class="box-product-adv">
                    <ul class="owl-carousel nav-center" data-items="1" data-dots="false" data-autoplay="true"
                        data-loop="true" data-nav="true">
                        @foreach($specialSliders as $specialSlider)
                            <li><a href="{{ $specialSlider->url }}"><img src="{{ asset('slider/'.$specialSlider->special_product_slider) }}" alt="{{ $specialSlider->special_product_slider }}"></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="box-product-list">
                <div class="tab-container">
                    <div id="tab-5" class="tab-panel specialProduct active">
                        <ul class="product-list owl-carousel nav-center" data-dots="false" data-loop="true"
                            data-nav="true" data-margin="10"
                            data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                            @foreach($specialProducts as $product)
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
    #cat_special_product {
        display:none;
    }
}
</style>