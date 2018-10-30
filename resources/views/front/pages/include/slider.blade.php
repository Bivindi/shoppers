<div id="home-slider">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 slider-left"></div>
            <div class="col-sm-9 header-top-right">
                <div class="header-top-right-wapper">
                    <div class="homeslider">
                        <div class="content-slide">
                            <ul id="contenhomeslider">
                                @foreach($mainSliders as $mainSlider)
                                    <li>
                                        <a href="{{ $mainSlider->url }}">
                                            <img alt="{{ $mainSlider->main_slider }}"
                                                 src="{{ asset('slider/'.$mainSlider->main_slider) }}"/>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>