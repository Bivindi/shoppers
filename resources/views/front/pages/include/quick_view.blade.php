<style>
    .select-color {
        cursor: pointer;
    }

    .product-color {
        margin-bottom: 30px;
    }

    .color-choose div {
        display: inline-block;
    }

    .color-choose input[type="radio"] {
        display: none;
    }

    .color-choose input[type="radio"] + label span {
        display: inline-block;
        width: 30px;
        height: 30px;
        margin: -1px 4px 0 0;
        vertical-align: middle;
        cursor: pointer;
        border-radius: 50%;
    }

    .color-choose input[type="radio"] + label span {
        border: 2px solid #FFFFFF;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<div id="product" class="block-quickview">
    <div class="primary-box row">
        <div class="pb-left-column col-xs-12 col-sm-5">
            <!-- product-imge-->
            <div class="product-image">
                <div class="product-full">
                    <img id="product-zoom" src='{{ asset('420ProductImg/'.$product->product_img) }}'
                         data-zoom-image="{{ asset('850ProductImg/'.$product->product_img) }}"/>
                </div>
                <div class="product-img-thumb" id="gallery_01">
                    <ul class="owl-carousel" data-items="3" data-nav="true" data-dots="false" data-margin="20"
                        data-loop="false">
                        @foreach($product->productScreenshots()->get() as $screenshot)
                            <li>
                                <a href="#" data-image="{{ asset('420ProductImg/'.$screenshot->screenshots) }}"
                                   data-zoom-image="{{ asset('850ProductImg/'.$screenshot->screenshots) }}">
                                    <img id="product-zoom" src="{{ asset('100ProductImg/'.$screenshot->screenshots) }}"/>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- product-imge-->
        </div>
        <div class="pb-right-column col-xs-12 col-sm-6">
            <h1 class="product-name">{{ $product->name }}</h1>
            <div class="product-comments">
                <div class="product-star">
                    <div class="ratiyo-rating" data-rating="{{ $product->getAvgRating() }}"></div>
                </div>
                <div class="comments-advices">
                    <a href="javascript:void(0);">Based on {{ $product->getAvgRating() }} ratings</a>
                </div>
            </div>
            <div class="product-price-group">
                @if(count($product->getDiscountPrice())>0)
                    <span class="price"><i class="fa fa-inr"></i>{{ $product->getDiscountPrice() }}</span>
                    <span class="old-price"><i class="fa fa-inr"></i>{{ $product->price }}</span>
                @else
                    <span class="price"><i class="fa fa-inr"></i> {{ $product->price }}</span>
                @endif
            </div>
            <div class="info-orther">
                <p>Availability: <span class="in-stock">@if($product->quantity != 0)
                            In stock @else Not In Stock @endif</span></p>
                <p>Condition: New</p>
            </div>
            <div class="product-desc">
                {!! $product->desc !!}
            </div>
            <div class="form-option">
                <p class="form-option-title">Available Options:</p>
                @if(count($productColors)>0)
                    <div class="attributes">
                        <div class="attribute-label">Color:</div>
                        <div class="color-choose">
                            @foreach($productColors as $productColor)
                                <div>
                                    <input type="radio" class="select-color"
                                           id="{{ $productColor->desc }}" name="color"
                                           value="{{ $productColor->desc }}">
                                    <label for="{{ $productColor->desc }}"><span
                                                style="background-color: {{ $productColor->desc }}"></span></label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="attributes">
                    <div class="attribute-label">Qty:</div>
                    <div class="attribute-list product-qty">
                        <div class="qty">
                            <input id="option-product-qty" type="text" value="1">
                        </div>
                        <div class="btn-plus">
                            <a href="#" class="btn-plus-up">
                                <i class="fa fa-caret-up"></i>
                            </a>
                            <a href="#" class="btn-plus-down">
                                <i class="fa fa-caret-down"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="attributes">
                    <div class="attribute-label">Size:</div>
                    <div class="attribute-list">
                        <select>
                            <option value="1">X</option>
                            <option value="2">XL</option>
                            <option value="3">XXL</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="form-share">
                <div class="sendtofriend-print">
                    <a href="javascript:print();"><i class="fa fa-print"></i> Print</a>
                    <a href="#"><i class="fa fa-envelope-o fa-fw"></i>Send to a friend</a>
                </div>
                <div class="network-share">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script>
    $('.product-img-thumb .owl-carousel').owlCarousel(
        {
            dots: false,
            nav: true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            margin: 21,
            responsive: {
                // breakpoint from 0 up
                0: {
                    items: 2,
                },
                // breakpoint from 480 up
                480: {
                    items: 2,
                },
                // breakpoint from 768 up
                768: {
                    items: 2,
                },
                1000: {
                    items: 3,
                }
            }
        }
    );
</script>