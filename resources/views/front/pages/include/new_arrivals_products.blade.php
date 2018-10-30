<div class="box-products new-arrivals">
    <div class="container" style="background: #fff;padding: 0.5%;box-shadow: 0px 1px 2px 3px #00000040;">
        <div class="box-product-head">
            <span class="box-title">NEW ARRIVALS IN</span>
            <ul class="box-tabs nav-tab new-arrivals" id="cat_new_arrivals">
                <li class="active"><a class="category-product" type="new_arrival" catId="all"
                                      href="javascript:void(0);">All</a></li>
                @foreach($newArrivalsCategories as $category)
                    <li><a class="category-product" type="new_arrival" catId="{{ $category->id }}"
                           href="javascript:void(0);">{{ ucwords($category->name) }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="box-product-content">
            @if(count($newArrivalSliders)>0)
                <div class="box-product-adv">
                    <ul class="owl-carousel nav-center" data-items="1" data-dots="false" data-autoplay="true"
                        data-loop="true" data-nav="true">
                        @foreach($newArrivalSliders as $arrivalSlider)
                            <li><a href="{{ $arrivalSlider->url }}"><img src="{{ asset('slider/'.$arrivalSlider->new_arrival_slider) }}" alt="{{ $arrivalSlider->new_arrival_slider }}"></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="box-product-list">
                <div class="tab-container">
                    <div class="tab-panel newCatProduct active">
                        <ul class="product-list owl-carousel nav-center" data-dots="false" data-loop="true"
                            data-nav="true" data-margin="10"
                            data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                            @foreach($newArrivalsProducts as $product)
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
    #cat_new_arrivals {
        display:none;
    }
}
</style>