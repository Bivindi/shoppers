@if(count($topSellerHorizontalSliders)>0)
    <div class="block-banner">
        <div class="container">
            @foreach($topSellerHorizontalSliders as $horizontalSlider)
                <div class="block-banner-left">
                    <div class="banner-opacity">
                        <a href="{{ $horizontalSlider->url }}"><img src="{{ asset('slider/'.$horizontalSlider->seller_horizontal_slider) }}" alt="{{ $horizontalSlider->seller_horizontal_slider }}"></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif