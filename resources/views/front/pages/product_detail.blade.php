@extends('front.layout.default')
@section('title')
   {{ $product->name }}
@endsection

@section('metadescription')
    {{ $product->name }}
@endsection
@section('page-css')
<link rel="stylesheet" href="{{ asset('front/css/lightslider.min.css') }}">
<link rel="stylesheet" href="{{ asset('front/css/rateyo.css') }}">
<style>
/* The container */
.container-radio {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default radio button */
.container-radio input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container-radio:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container-radio input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the indicator (dot/circle) when checked */
.container-radio input:checked ~ .checkmark:after {
    display: block;
}

/* Style the indicator (dot/circle) */
.container-radio .checkmark:after {
    top: 9px;
    left: 9px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
}
.wd-shop-btn
{
    background: #FFA02A !important;
}
.wd-shop-btn:hover
{
    color : #fff !important;
}
.heart-radius
{
    border: 1px solid #c3c3c3;
    border-radius: 50%;
    padding: 10px;
    background: #f0f3f6

}
.signal-radius
{
    border: 1px solid #c3c3c3;
    border-radius: 50%;
    padding: 10px;
    background: #f0f3f6

}
.old-price
{
    text-decoration: line-through;
    color: gray;
}
.wishlisted-icon
{
    background: #ff3366 !important;
}
.rating-yellow
{
    color: #ff9f00 !important;
}
.rating-red
{
    color: #ff6161 !important;
}


.sticky{
    position: sticky;
    top: 100px;
}

.price{
    font-size: 20px;
    font-weight: bold;
}
.product-details-gallery .product-content {
    padding-left: 4%;
    padding-right: 1%;
    padding-top:20px;
    padding-bottom: 20px;
    color: #666666; 
}
.product-details-gallery .option-content,.product-details-gallery .specific,.product-details-gallery .description_table,.product-details-gallery .reviews{
    padding-top:20px;
    padding-bottom: 20px;
    color: #666666; 
}
.product-details-gallery h3{
    font-weight: 200;
}
.product-details-gallery h5{
    font-weight: 200;
}
.product-details-gallery .product-desc{
    padding-top:20px;
    padding-bottom: 20px;
    color: #000;
}

.option-content .lst .wish,.option-content .lst .comp{
    color: #666666;
    text-align: center;
    margin-right: 20px;
}
.av_option{
    font-size:20px;
    font-weight: bold;
}
.op_icon{
    background-color: #f5f5f5;
    border:1px solid #8c8c8c;
    padding: 5px;
    margin-left: 20px; 
    border-radius: 20px;
}
.option-content .lst .wish .fa:hover{
    color: #ff2f00;
}
.black{
    background-color: #000;
    border-radius: 50%;
    padding: 10px 20px;
}
.gold{
    background-color: #ecc993;
    border-radius: 50%;
    padding: 10px 20px;
}
.color_bt{
    border-top: 1px;
}
.op-tab tr:not(:first-child) td{
    padding:20px 1px;
    border-top: 1px solid #ecebeb;
}
.mt-10{
    margin-right: 10px;
}
.btn_cart{
    font-weight: bold;
    background-color: #f78c07;
    border:1px solid #0854c5; 
    opacity: 0.8;
}
.btn_cart:hover{
    font-weight: bold;
    opacity: 1;
}
.specific_table tbody>tr>td{
    padding-bottom: 5px;
    padding-top: 15px;
}
.specific_table tr .wid-25{
    width: 25%;
}
.specific_table tr .wid-75{
    width: 75%;
    color: black;
}
.description_table .more-text{
    display: none;
}

.color-choose input[type="radio"] + label span{
    border: 2px solid #FFFFFF;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
    display: inline-block;
    width: 30px;
    height: 30px;
    margin: -1px 4px 0 0;
    vertical-align: middle;
    cursor: pointer;
    border-radius: 50%;
}

.color-choose input[type="radio"]:checked + label span {
    background-image: url('/assets/images/check-icn.png');
    background-repeat: no-repeat;
    background-position: center;
}

.color-choose-img input[type="radio"] + label img{
    border: 2px solid #FFFFFF;/*
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);*/
    display: inline-block;
    width: 70px;
    height: 120px;
    margin: -1px 4px 0 0;
    vertical-align: middle;
    cursor: pointer;
}

.color-choose-img input[type="radio"]:checked + label img {
    border: 2px solid #98c1f5;
}
.qty input[type="number"]{
    width: 30%;
}

.choose-size input[type="radio"] + label span{
    border: 1px solid #e2e0e0;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
    display: inline-block;
    width: 32px;
    padding-top: 4px;
    text-align: center;
    font-weight: bold;
    height: 30px;
    margin: -1px 4px 0 0;
    cursor: pointer;
}
.choose-size input[type="radio"]:checked + label span{
    border: 1px solid #3b90fd;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
    display: inline-block;
    width: 32px;
    color: #3b90fd;
    font-weight: bold;
    padding-top: 4px;
    text-align: center;
    height: 30px;
    margin: -1px 4px 0 0;
    cursor: pointer;
}
.size-chart{
    color: #3b90fd;
    font-weight: bold;
}
.size .dropdown-toggle::after {
    display: none;
    width: 0;
    height: 0;
    margin-left: .255em;
    vertical-align: .255em;
    content: "";
    border-top: .3em solid;
    border-right: .3em solid transparent;
    border-left: .3em solid transparent;
}
.product_desc_table tbody>tr>td{
    padding-bottom: 5px;
    padding-top: 15px;
}
.product_desc_table tr .wid-20{
    width: 20%;
}
.product_desc_table tr .wid-40{
    width: 40%;
}
.product_desc_table tr .wid-60{
    width: 60%;
    color: black;
}
.product-core{
    font-size: 22px;
    font-weight: 400;
    color: #212121;
    line-height: 1;
}
.product-core-sup{
    font-size: 14px;
    font-weight: 400;
    color: #212121;
    padding-left: 2px;
}
.product-row{
    border-top: 1px solid #ececec;
    padding: 25px 10px;
}
.review-rating {
    position: absolute;
    top: 50%;
    left: 66%;
    transform: translate(-68%, -50%);
}
.review_btn:hover{
    color: #fff;
    background: #ff9800;
    border-color: #ff9800;
}



</style>
@endsection

@section('page-content')

    <!-- =========================
        Product Details Section
    ============================== -->

    <section class="product-details">
        <div class="container">
            <div class="row">
                <div class="col-12 p0">
                    <div class="page-location">
                        <ul>
                            <li><a href="#">
                                <a href="#">Home / {{ $product->CatName }}</a> / <a href="#">{{ $product->subCatName }}</a> /
                            </a></li>
                            <li><a class="page-location-active" href="#">
                                {{ $product->name }}
                                <span class="divider">/</span>
                            </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 product-details-section">
                    <!-- ====================================
                        Product Details Gallery Section
                    ========================================= -->
                    <div class="row">
                        <div class="product-gallery col-12 col-md-12 col-lg-6">
                            <!-- ====================================
                                Single Product Gallery Section
                            ========================================= -->
                            <div class="row">
                                <div class="col-md-12 product-slier-details">
                                    <ul id="lightSlider">
                                        @if(isset($slideimages))
                                            <li data-thumb="{{ asset('100ProductImg/'.$product->product_img) }}">
                                                <img  class="figure-img img-fluid data-image" src="{{ asset('420ProductImg/'.$product->product_img) }}" alt="product-img" style="width: 100%; height: 450px;" />
                                            </li>

                                            @if(!empty($slideimages->image1))
                                            <li data-thumb="{{ asset('100ProductImg/'.$slideimages->image1) }}">
                                                <img  class="figure-img img-fluid data-image" src="{{ asset('420ProductImg/'.$slideimages->image1) }}" alt="product-img" style="width: 100%; height: 450px;" />
                                            </li>
                                            @endif

                                            @if(!empty($slideimages->image2))
                                            <li data-thumb="{{ asset('100ProductImg/'.$slideimages->image2) }}">
                                                <img  class="figure-img img-fluid data-image" src="{{ asset('420ProductImg/'.$slideimages->image2) }}" alt="product-img" style="width: 100%; height: 450px;" />
                                            </li>
                                            @endif

                                            @if(!empty($slideimages->image3))
                                            <li data-thumb="{{ asset('100ProductImg/'.$slideimages->image3) }}">
                                                <img  class="figure-img img-fluid data-image" src="{{ asset('420ProductImg/'.$slideimages->image3) }}" alt="product-img" style="width: 100%; height: 450px;" />
                                            </li>
                                            @endif

                                            @if(!empty($slideimages->image4))
                                            <li data-thumb="{{ asset('100ProductImg/'.$slideimages->image4) }}">
                                                <img  class="figure-img img-fluid data-image" src="{{ asset('420ProductImg/'.$slideimages->image4) }}" alt="product-img" style="width: 100%; height: 450px;" />
                                            </li>
                                            @endif

                                            @if(!empty($slideimages->image5))
                                            <li data-thumb="{{ asset('100ProductImg/'.$slideimages->image5) }}">
                                                <img  class="figure-img img-fluid data-image" src="{{ asset('420ProductImg/'.$slideimages->image5) }}" alt="product-img" style="width: 100%; height: 450px;" />
                                            </li>
                                            @endif
                                        @else
                                            <li data-thumb="{{ asset('100ProductImg/'.$product->product_img) }}">
                                                <img  class="figure-img img-fluid data-image" src="{{ asset('420ProductImg/'.$product->product_img) }}" alt="product-img" style="width: 100%; height: 450px;" />
                                            </li>
                                            <!-- @foreach($productColors as $key => $productColor)
                                                <li data-thumb="{{ asset('100ProductImg/'.$productColor->screenshots) }}">
                                                <img  class="figure-img img-fluid data-image" src="{{ asset('420ProductImg/'.$productColor->screenshots) }}" alt="product-img" style="width: 100%; height: 450px;" />
                                            </li>        
                                            @endforeach -->
                                            @foreach($product->productScreenshots()->select('id','screenshots')->get() as $screenshot)
                                                @if($product->isProductColorImage($screenshot->id))
                                                <li data-thumb="{{ asset('100ProductImg/'.$screenshot->screenshots) }}">
                                                    <img  class="figure-img img-fluid data-image" src="{{ asset('420ProductImg/'.$screenshot->screenshots) }}" alt="product-img" style="width: 100%; height: 450px;" />
                                                </li>
                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-12 col-md-12 col-lg-6">
                            <div class="product-details-gallery">
                                <div class="list-group">
                                    <h4 class="list-group-item-heading product-title">
                                        {{ ucwords($product->name) }}
                                    </h4>
                                    <div class="media">
                                        <div class="media-left media-middle">
                                            <div class="rating">
                                                @for($i = 1;$i < 6;$i++)
                                                    @if($i <= $product->getAvgRating())
                                                        <a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
                                                    @else
                                                        <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p>{{ $product->getAvgRating() }}/5</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group content-list">
                                    <table style="width: 50%">
                                        <tr>
                                            @if($product->getDiscountPrice()>0)
                                                <td>
                                                    <span class="price"><i class="fa fa-inr"></i> {{ $product->getDiscountPrice() }}</span>
                                                </td>
                                                <td>
                                                    <span class="old-price"><i class="fa fa-inr"></i>{{ $product->price }}</span>
                                                </td>
                                                @if($product->getDiscountPercentage()>0)
                                                    <td><span class="badge badge-secondary wd-badge text-uppercase" style="position: unset;">{{ $product->getDiscountPercentage() }}%</span></td>
                                                @endif
                                            @else
                                                <td>
                                                    <span class="price" price="{{ $product->price }}"><i class="fa fa-inr"></i>
                                                        <p id="myprice" style="display: inline;">
                                                            @if(isset($productPrice))
                                                            {{ $product->price + $productPrice->product_price }}
                                                            @else
                                                            {{ $product->price }}
                                                            @endif
                                                        </p>
                                                    </span>
                                                </td>
                                            @endif
                                        </tr>
                                    </table>

                                    <p>
                                        <i class="fa fa-dot-circle-o" aria-hidden="true"></i> Sold By :  @if($product->username == 'admin')LozyPay @else {{ $product->username }} @endif
                                    </p>

                                    <p>
                                        <i class="fa fa-dot-circle-o" aria-hidden="true"></i>Availability : @if($product->quantity != 0) In stock @else Not In Stock @endif
                                    </p>
                                    <p>
                                        <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                                        Condition: New
                                    </p>
                                </div>
                                <div class="list-group product-content">
                                    <p> {!! mb_strimwidth($product->desc, 0, 200, '...') !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                <div class="wd-tab-section">
                    <div class="bd-example bd-example-tabs">
                        <ul class="nav nav-pills mb-3 wd-tab-menu" id="pills-tab" role="tablist">
                            <li class="nav-item col-6 col-md">
                                <a class="nav-link active" href="#options-section" aria-expanded="true" data-toggle="pill" role="tab" aria-controls="options" id="options-tab">Purchase options</a>
                            </li>
                            <li class="nav-item col-6 col-md">
                                <a class="nav-link" id="description-tab" data-toggle="pill" href="#description-section" role="tab" aria-controls="description-section" aria-expanded="true">Description</a>
                            </li>
                            <li class="nav-item col-6 col-md">
                                <a class="nav-link" id="reviews-tab" data-toggle="pill" href="#reviews" role="tab" aria-controls="reviews" aria-expanded="false">Reviews</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade active show specifiction-section"  aria-labelledby="options-tab""  id="options-section" role="tabpanel" aria-expanded="true">
                                <div class="row">
                                    <table>
                                        <form id="productInfo">
                                            {{ csrf_field() }}
                                            <div class="col-md-12">
                                                    @if(count($productColors)>0)
                                                        <tr>
                                                            <td class="col-md-6">
                                                                <span class="mt-10">Color</span>
                                                            </td>
                                                            <td class="col-md-6">
                                                                <span class="color-choose">
                                                                    @foreach($productColors as $key => $productColor)
                                                                        <input type="radio" 
                                                                            class="select-color 
                                                                            @if(isset($slideimages)) 
                                                                                @if($productColor->id==$slideimages->attribute_id) 
                                                                                    active 
                                                                                @endif 
                                                                            @endif" 
                                                                            altss="{{ $key }}" 
                                                                            id="{{ $productColor->desc }}" 
                                                                            name="color" 
                                                                            value="{{ $productColor->desc }}"  
                                                                            style="display: none;" 
                                                                            color_price="{{ $productColor->product_price }}" 
                                                                            attribute_id="{{ $productColor->id }}" @if(isset($slideimages))
                                                                            @if($productColor->id==$slideimages->attribute_id) checked="checked" @endif @endif
                                                                        />
                                                                        <label for="{{ $productColor->desc }}">
                                                                            <a href="{{ route('get:product_detail2', ['slug' => $product->slug, 'colorid' => $productColor->id]) }}">
                                                                                <span style="background-color:  {{ $productColor->desc }}" ></span>
                                                                            </a>
                                                                        </label>
                                                                    @endforeach
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @if(count($productSizesColors)>0)
                                                        <tr class="colors">
                                                            <td>
                                                                <span class="mt-10">Color</span>
                                                            </td>
                                                            <td>
                                                                <span class="color-choose">
                                                                    @foreach($productSizesColors->unique('desc') as $key => $productColor)
                                                                        <input type="radio" 
                                                                            class="select-color 
                                                                                @if(isset($slideimages)) 
                                                                                    @if($productColor->id==$slideimages->attribute_id) 
                                                                                        active 
                                                                                    @endif
                                                                                @endif" 
                                                                            altss="{{ $key }}" 
                                                                            id="{{ $productColor->desc }}" 
                                                                            name="color" 
                                                                            value="{{ $productColor->desc }}"  
                                                                            style="display: none;" 
                                                                            color_price="{{ $productColor->product_price }}" 
                                                                            attribute_id="{{ $productColor->id }}" 
                                                                            @if(isset($slideimages))
                                                                                @if($productColor->id==$slideimages->attribute_id) 
                                                                                    checked="checked" 
                                                                                @endif
                                                                            @endif 
                                                                        />
                                                                        <label for="{{ $productColor->desc }}">
                                                                            <a href="{{ route('get:product_detail2', ['slug' => $product->slug, 'colorid' => $productColor->id]) }}">
                                                                                <span style="background-color:  {{ $productColor->desc }}" ></span>
                                                                            </a>
                                                                        </label>
                                                                    @endforeach
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        @if($product->quantity != 0)
                                                        <tr class="qty">
                                                            <td>
                                                                <span class="mt-10">Quantity</span>
                                                                <span> <input id="option-product-qty" type="number" min="1" name="product_qty" value="1" style="max-width: 50px;padding: 5px 0 5px 0;background: #f0f3f6;border: 1px solid #c3c3c3;"></span>
                                                            </td>
                                                        </tr>
                                                        @else
                                                        <tr class="qty">
                                                            <td>
                                                                <span class="mt-10">Qty</span>
                                                                <span>Out of stock</span>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                    @endif
                                                    @if(count($productSizes) > 0)
                                                        <tr class="size">
                                                            <td>
                                                                <span class="mt-10">Size</span>
                                                                <span class="choose-size mt-10">

                                                                    @foreach($productSizes as $productSize)
                                                                    <input type="radio" class="select-size" id="{{ $productSize->desc }}" name="size" value="{{ $productSize->desc }}" style="display: none;">
                                                                    <label for="{{ $productSize->desc }}">
                                                                        <span class="size-nm">{{ $productSize->desc }}</span>
                                                                    </label>
                                                                    @endforeach
                                                                    <!-- <input type="radio" class="select-size" id="md" name="size" value="md" checked="" style="display: none;">
                                                                    <label for="md">
                                                                        <span class="size-nm">M</span>
                                                                    </label>

                                                                    <input type="radio" class="select-size" id="lg" name="size" value="lg" checked="" style="display: none;">
                                                                    <label for="lg">
                                                                        <span class="size-nm">L</span>
                                                                    </label>

                                                                    <input type="radio" class="select-size" id="xl" name="size" value="xl" checked="" style="display: none;">
                                                                    <label for="xl">
                                                                        <span class="size-nm">XL</span>
                                                                    </label> -->
                                                                </span>
                                                                <!-- <span class="mt-10 dropdown">
                                                                    <a href="" class="size-chart dropdown-toggle" data-toggle="dropdown">Size Chart</a>
                                                                    <span class="dropdown-menu">
                                                                        <img src="">
                                                                    </span>
                                                                </span> -->
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @if(count($productSizes) > 0)
                                                        <tr class="size">
                                                            <td>
                                                                <span class="mt-10">Size</span>
                                                                <span class="choose-size mt-10">

                                                                    @foreach($productSizes as $productSize)
                                                                    <input type="radio" class="select-size" id="{{ $productSize->desc }}" name="size" value="{{ $productSize->desc }}" style="display: none;">
                                                                    <label for="{{ $productSize->desc }}">
                                                                        <span class="size-nm">{{ $productSize->desc }}</span>
                                                                    </label>
                                                                    @endforeach
                                                                    <!-- <input type="radio" class="select-size" id="md" name="size" value="md" checked="" style="display: none;">
                                                                    <label for="md">
                                                                        <span class="size-nm">M</span>
                                                                    </label>

                                                                    <input type="radio" class="select-size" id="lg" name="size" value="lg" checked="" style="display: none;">
                                                                    <label for="lg">
                                                                        <span class="size-nm">L</span>
                                                                    </label>

                                                                    <input type="radio" class="select-size" id="xl" name="size" value="xl" checked="" style="display: none;">
                                                                    <label for="xl">
                                                                        <span class="size-nm">XL</span>
                                                                    </label> -->
                                                                </span>
                                                                <!-- <span class="mt-10 dropdown">
                                                                    <a href="" class="size-chart dropdown-toggle" data-toggle="dropdown">Size Chart</a>
                                                                    <span class="dropdown-menu">
                                                                        <img src="">
                                                                    </span>
                                                                </span> -->
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @if(isset($color_sizes))
                                                        @if(count($color_sizes) > 0)
                                                            <tr class="size">
                                                                <td>
                                                                    <span class="mt-10">Size</span>
                                                                    <span class="choose-size mt-10">

                                                                        @foreach($color_sizes as $productSize)
                                                                            <input type="radio" class="select-size" id="{{ $productSize->desc2 }}" name="size" value="{{ $productSize->desc2 }}"  style="display: none;" price="{{ $productSize->product_price }}">
                                                                            <label for="{{ $productSize->desc2 }}">
                                                                                <span class="size-nm">{{ $productSize->desc2 }}</span>
                                                                            </label>
                                                                        @endforeach
                                                                    
                                                                    </span>
                                                       
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                    <tr class="cart">
                                                        <td>
                                                            <a class="btn btn_cart btn-add-cart" style="color: #000;" slug="{{ $product->slug }}"><i class="fa fa-shopping-cart" aria-hidden="true" style="margin-right:10px;"></i> Add to cart </a>
                                                        </td>
                                                    </tr>
                                            </div>

                                            @if($product->getDiscountPrice()>0)
                                                <input type="hidden" name="price" value="{{ $product->getDiscountPrice() }}">
                                            @else
                                                <input type="hidden" name="price" value="@if(isset($productPrice)){{ $product->price + $productPrice->product_price }}@else{{ $product->price }}@endif">
                                            @endif
                                            <input type="hidden" name="slug" value="{{ $product->slug }}">

                                            <tr class="lst">
                                                <td>
                                                    <a class=" wish wishlist " id="wishlist" productId="{{ $product->id }}" style="position: unset;font-size:15px;"><i class="fa fa-heart-o heart-radius @if($product->isWishListProducts()) wishlisted-icon @endif"></i><br>Wishlist</a>
                                                </td>
                                                <td>        
                                                    <a class="comp compare compare-product" productId="{{ $product->id }}"><i class="fa fa-signal  @if($product->iscompareProducts()) wishlisted-icon @endif signal-radius"></i><br>Compare</a>
                                                </td>
                                            </tr>
                                        </form>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="description-section">
                                <div class="product-tab-content">
                                    <h4 class="description-title">{{ $product->name }}</h4>

                                    <h3>Specifications</h3>
                                    <hr>
                                    <div class="specific">
                                        <h5>General specification</h5>
                                        <table class="specific_table">
                                            <tbody>
                                                @foreach($product->ProductAttributes()->where('name', '!=', 'color')->where('name', '!=', 'size')->where('name', '!=', 'size_color')->select('name', 'desc')->get() as $productAttribute)
                                            <tr>
                                                <td class="wid-25">{{ $productAttribute->name }}</td>
                                                <td class="wid-75">{{ $productAttribute->desc }}</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    @if($product->url)
                                    <div class="product-row">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <iframe width="100%" height="315" src="{{ $product->url }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                            </div>
                                        </div>                                       
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade reviews-section" id="reviews">
                                <div class="row">
                                    <div class="col-12">
                                        <h3>Ratings and Reviews</h3>
                                <hr>
                                <div class="specific">
                                    <h5 class="h5">Average Ratings and Reviews</h5>
                                    <hr>
                                        <div class="row tab-rating-bar-section">
                                            <div class="col-8 col-md-6 col-lg-4">
                                                <img src="{{ asset('assets/images/review-bg.png') }}" alt="review-bg">
                                                <div class="review-rating text-center">
                                                    <h1 class="@if($product->getAvgRating() >= 3){{ 'rating' }}@elseif($product->getAvgRating() == 2){{ 'rating-yellow' }}@else{{ 'rating-red' }}@endif">{{ $product->getAvgRating() }}</h1>
                                                    <p>{{ count($productReviews) }} Ratings &amp; {{ count($productReviews) }} Reviews</p>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 rating-bar-section">
                                                <div class="media rating-star-area">
                                                    <p>5 <i class="fa fa-star" aria-hidden="true"></i></p>
                                                    <div class="media-body rating-bar">
                                                        <div class="progress wd-progress">
                                                            <div class="progress-bar wd-bg-green" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media rating-star-area">
                                                    <p>4 <i class="fa fa-star" aria-hidden="true"></i></p>
                                                    <div class="media-body rating-bar">
                                                        <div class="progress wd-progress">
                                                            <div class="progress-bar wd-bg-green" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media rating-star-area">
                                                    <p>3 <i class="fa fa-star" aria-hidden="true"></i></p>
                                                    <div class="media-body rating-bar">
                                                        <div class="progress wd-progress">
                                                            <div class="progress-bar wd-bg-green" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media rating-star-area">
                                                    <p>2 <i class="fa fa-star" aria-hidden="true"></i></p>
                                                    <div class="media-body rating-bar">
                                                        <div class="progress wd-progress">
                                                            <div class="progress-bar wd-bg-yellow" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media rating-star-area">
                                                    <p>1 <i class="fa fa-star" aria-hidden="true"></i></p>
                                                    <div class="media-body rating-bar">
                                                        <div class="progress wd-progress">
                                                            <div class="progress-bar wd-bg-red" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="specific">
                                        <h5 class="h5">Ratings and Reviews From Market</h5>
                                        <hr>
                                        <!-- =================================
                                            Review Client Section
                                            ================================= -->
                                        @if(count($productReviews) > 0)
                                            @foreach($productReviews as $productReview)
                                                <div class="col-12 review-our-product-area">

                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="media">
                                                                      <div class="media-left media-middle">
                                                                        
                                                                      </div>
                                                                      <div class="media-body">
                                                                        <h2>{{ $productReview->username }}</h2>
                                                                        <h4 class="media-heading client-title">{{ $productReview->title }}</h4>
                                                                        <div class="client-subtitle">{{ $productReview->desc }}</div>
                                                                      </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6 review-date-time">
                                                            <p class="review-date">{{ \Carbon\Carbon::parse($productReview->created_at)->format('d/m/Y') }}</p>
                                                            <!-- <p class="review-time">at 11:52 pm</p> -->
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12"></div>
                                                        <div class="col-6 col-md-4">
                                                            <div class="rating-market-section">
                                                                <span class="badge badge-secondary wd-star-market-badge text-uppercase">{{ $productReview->rating }} <i class="fa fa-star-o" aria-hidden="true"></i></span>
                                                                <div class="rating-star">
                                                                    <div class="review-rating-light-yellow-{{ $productReview->rating }}"></div><span class="rating-number">{{ $productReview->rating }}</span>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @else
                                                No review has been registered yet.
                                            @endif
                                    </div>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            
            @if(isset($similarProducts) &&  count($similarProducts)>0)
                <div class="row related-product">
                    <h4 class="related-product-title">Related Items</h4>
                    <div id="related-product" class="owl-carousel owl-theme">
                        @foreach($similarProducts as $similarProduct)
                        <div class="col-12">
                            <figure class="figure product-box">
                                <div class="product-box-img">
                                    <a href="{{ route('get:product_detail', $similarProduct->slug) }}">
                                        <img src="{{ asset('300ProdctImg/'.$similarProduct->product_img) }}" class="figure-img img-fluid" alt="Product Img">
                                    </a>
                                </div>
                                <div class="quick-view-btn">
                                    <div class="compare-btn">
                                        <a class="btn btn-primary btn-sm" href="{{ route('get:product_detail', $similarProduct->slug) }}"><i class="fa fa-eye" aria-hidden="true"></i> Quick view</a>
                                    </div>
                                </div>
                                <figcaption class="figure-caption text-center">
                                    <!-- <span class="badge badge-secondary wd-badge text-uppercase">New</span> -->
                                    <div class="wishlist-related-product" productId="{{ $similarProduct->id }}">
                                        @if($similarProduct->isWishListProducts())
                                            <i class="fa fa-heart" aria-hidden="true"  style="color:#ff4a4a"></i>
                                        @else
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        @endif
                                    </div>
                                    <div class="price-start">
                                        <p>Price start from   <strong class="active-color">
                                        @if($similarProduct->getDiscountPrice()>0)
                                            <u><span class="price" style="font-size: 14px;"><i class="fa fa-inr"></i> {{ $similarProduct->getDiscountPrice() }}</span></u>
                                        
                                            <u><span class="old-price"><i class="fa fa-inr"></i>{{ $product->price }}</span></u>
                                        @else
                                            
                                            <u><span class="price"><i class="fa fa-inr"></i> {{ $similarProduct->price }}</span></u>
                                            
                                        @endif
                                        </strong></p>
                                    </div>
                                    <div class="content-excerpt">
                                        <p>{{ $similarProduct->name }}</p>
                                    </div>
                                    <div class="rating">
                                        @for($i = 1;$i < 6;$i++)
                                            @if($i <= $similarProduct->getAvgRating())
                                                <a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
                                            @else
                                                <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="compare-btn">
                                        <a class="btn btn-primary btn-sm" href="{{ route('get:product_detail', $similarProduct->slug) }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart</a>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(isset($recentViewsProducts) &&  count($recentViewsProducts)>0)
                <div class="row related-product">
                    <h4 class="related-product-title">YOU RECENTLY VIEWS</h4>
                    <div id="related-product-view" class="owl-carousel owl-theme">
                        @foreach($recentViewsProducts as $recentproduct)
                            <div class="col-12">
                                <figure class="figure product-box">
                                    <div class="product-box-img">
                                        <a href="{{ route('get:product_detail', $recentproduct->slug) }}">
                                            <img src="{{ asset('300ProdctImg/'.$recentproduct->product_img) }}" class="figure-img img-fluid" alt="Product Img">
                                        </a>
                                    </div>
                                    <div class="quick-view-btn">
                                        <div class="compare-btn">
                                            <a class="btn btn-primary btn-sm" href="{{ route('get:product_detail', $recentproduct->slug) }}"><i class="fa fa-eye" aria-hidden="true"></i> Quick view</a>
                                        </div>
                                    </div>
                                    <figcaption class="figure-caption text-center">
                                        <!-- <span class="badge badge-secondary wd-badge text-uppercase">New</span> -->
                                        <div class="wishlist-related-product" productId="{{ $recentproduct->id }}">
                                            @if($recentproduct->isWishListProducts())
                                                <i class="fa fa-heart" aria-hidden="true"  style="color:#ff4a4a"></i>
                                            @else
                                                <i class="fa fa-heart" aria-hidden="true"></i>
                                            @endif
                                        </div>
                                        <div class="price-start">
                                            <p>Price start from   <strong class="active-color">
                                            @if($recentproduct->getDiscountPrice()>0)
                                                <u><span class="price" style="font-size: 14px;"><i class="fa fa-inr"></i> {{ $recentproduct->getDiscountPrice() }}</span></u>
                                            
                                                <u><span class="old-price"><i class="fa fa-inr"></i>{{ $product->price }}</span></u>
                                            @else
                                                
                                                <u><span class="price"><i class="fa fa-inr"></i> {{ $recentproduct->price }}</span></u>
                                                
                                            @endif
                                            </strong></p>
                                        </div>
                                        <div class="content-excerpt">
                                            <p>{{ $recentproduct->name }}</p>
                                        </div>
                                        <div class="rating">
                                            @for($i = 1;$i < 6;$i++)
                                                @if($i <= $recentproduct->getAvgRating())
                                                    <a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
                                                @else
                                                    <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                                @endif
                                            @endfor
                                        </div>
                                        <div class="compare-btn">
                                            <a class="btn btn-primary btn-sm" href="{{ route('get:product_detail', $recentproduct->slug) }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart</a>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection 
@section('page-js')

<script>
    /*====================================
            Stick Product
====================================*/
  
    if ($(window).width() >= 992) {
            var distt = 55;
            $('.sticker-product').sticky({
                topSpacing: distt
            });

            $(window).scroll(function() {

                var spx = $(window).scrollTop();
                var scrollTop     = $(window).scrollTop();
                var elementOffset = $('.related-product').offset().top;
                var productdetailtop = $('.product-slier-details').offset().top;
                var distance      = (elementOffset - scrollTop); 
                var high = $('.product-gallery').height() - 590;
                var tag1 = $("#wd-header-top").height();
                var tag2 = $("#wd-header").height();
                var tag3 = $("#main-menu-sticky-wrapper").height();
                var tt = tag1 + tag2 + tag3;
                var topdd = productdetailtop - distt + 1;
                 //$('.main-menu-list').html(scrollTop+'/'+high+'/'+productdetailtop);
                 //alert(scrollTop);
                if(distance < 675){

                   $('.sticker-product').css('position','relative').css('top', high+'px');

                }else if(scrollTop < topdd){

                    $('.sticker-product').removeAttr('style');

                }else{

                    $('.sticker-product').css('position','fixed').css('top','55px');

                }

            });

            
        }

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


        $(document).on('click', '#product-video', function (e) {
            e.preventDefault();
            var modal = $('#defaultModal');
            setTimeout(function () {
                modal.modal('show');
            }, 230);
            var videId = $(this).attr('videoId');
            if (videId) {
                $('.modal-title').html('{{ $product->name }}');
                var url = '//www.youtube.com/embed/' + videId + '?rel=0';
                $('.modal-body').html('<iframe id="cartoonVideo" width="560" height="315" src="' + url + '" frameborder="0" allowfullscreen></iframe>');
            }
        });

        $(document).on('click', '.compare-product', function (e) {
            e.preventDefault();
            var productId = $(this).attr('productId');
            var compare = $(this);
            $.ajax({
                type: 'get',
                url: "{{ route('get:add_to_compare') }}",
                data: {productId: productId},
                beforeSend: function () {
                    $(this).attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        if (result.count != 0) {
                            showCompareBtn();
                        } else {
                            $('.compare-filed').html('');
                        }
                        $.notify(result.message, "success");
                        if (result.added == 1) {
                            compare.addClass('wishlisted');
                            compare.find('i').addClass('wishlisted-icon');
                        } else {
                            compare.removeClass('wishlisted');
                            compare.find('i').removeClass('wishlisted-icon');
                        }
                    }
                    if (result.error == true) {
                        $.notify(result.message, "error");
                        compare.removeClass('wishlisted');
                        compare.find('i').removeClass('wishlisted-icon');
                    }
                }
            });
        });

        $(document).on('click', '.btn-comment', function (e) {
            @if(Auth::check())
            e.preventDefault();
            var productId = $(this).attr('productId');
            $.ajax({
                type: 'get',
                url: "{{ route('get:add_review_form') }}",
                data: {productId: productId},
                beforeSend: function () {
                    $(this).attr('disabled', true);
                },
                success: function (result) {
                    $('.reviewForm').html(result);
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            });
            @else
            // $('#loginRegister').trigger('click');
            $('.bd-example-modal-lg2').modal('show');
            $.notify("Please login for wishlisting a product", "error");
            @endif
        });

        $(document).on('submit', '#ratingForm', function (e) {
            e.preventDefault();
            var rating = $('.ratingValue').val();
            console.log(rating);
            if (rating == 0) {
                $.notify('Rating cannot be empty', "error");
                return false;
            }
            $.ajax({
                type: 'post',
                url: "{{ route('post:review') }}",
                data: $(this).serialize(),
                beforeSend: function () {
                    $("#btn-send-review").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                    $("#btn-send-review").attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        $('#ratingForm')[0].reset();
                        $("#btn-send-review").html('Submit');
                        $("#btn-send-review").attr('disabled', false);
                        location.reload();
                    }
                    if (result.success == false) {
                        $.notify(result.message, "error");
                        $("#btn-send-review").html('Submit');
                        $("#btn-send-review").attr('disabled', false);
                    }
                    if (result.error == true) {
                        $.each(result.message, function (index, error) {
                            var keys = Object.keys(result.message);
                            $('input[name="' + keys[0] + '"]').focus();
                            $('.' + index + '_error').html(error);
                        });
                        $(".btn-send-review").html('Submit');
                        $(".btn-send-review").attr('disabled', false);
                    }
                }
            });
        });

        $(document).on('click', '.search', function (e) {
            e.preventDefault();
            var productId = $(this).attr('productId');
            $.ajax({
                type: 'get',
                url: "{{ route('get:quick_view_search') }}",
                data: {productId: productId},
                success: function (result) {
                    $.fancybox(result, {
                        // fancybox API options
                        fitToView: false,
                        autoSize: false,
                        closeClick: false,
                        openEffect: 'none',
                        closeEffect: 'none'
                    });
                }
            });
        });

        function showCompareBtn() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:compare_btn') }}",
                success: function (result) {
                    $('.compare-filed').html(result);
                }
            });
        }

        $(document).on('click', '.wishlist', function (e) {
            e.preventDefault();
            var wishlist = $(this);
            var productId = $(this).attr('productId');
            @if(Auth::check())
            $.ajax({
                type: 'get',
                url: "{{ route('get:add_to_wishlist') }}",
                data: {productId: '{{ $product->id }}'},
                beforeSend: function () {
                    $(this).attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        wishlist.attr('disabled', false);
                        if (result.added == 1) {
                            wishlist.addClass('wishlisted');
                            wishlist.find('i').addClass('wishlisted-icon');
                        } else {
                            wishlist.removeClass('wishlisted');
                            wishlist.find('i').removeClass('wishlisted-icon');
                        }
                        $.notify(result.message, "success");
                    }
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            });
            @else
            // $('#loginRegister').trigger('click');
            $('.bd-example-modal-lg2').modal('show');
            $.notify("Please login for wishlisting a product", "error");
            @endif
        });

        $(document).on('click', '.wishlist-related-product', function (e) {
            e.preventDefault();
            var wishlist = $(this);
            // alert(wishlist);
            var productId = $(this).attr('productId');
            $.ajax({
                type: 'get',
                url: "{{ route('get:add_to_wishlist') }}",
                data: {productId: productId},
                beforeSend: function () {
                    $(this).attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        $.notify(result.message, "success");
                        location.reload();
                    }
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            });
        });

        $(document).ready(function () {
            $('.color-choose input').on('click', function () {
                $('.active').removeClass('active');
                $(this).addClass('active');
            });

        });


        $(document).on('click', '.select-color', function (e) {
            // $("#lightSlider").lightSlider().goToSlide(4);
            // slider.goToSlide(4);
            var val = $(this).attr('color_price');
            $('#myprice').html(val);
        });

        $(document).on('click', '.select-size', function (e) {
            // $("#lightSlider").lightSlider().goToSlide(4);
            // slider.goToSlide(4);
            var color_price = $(this).attr('price');
            var main_price = $('.price').attr('price');
            var totalprice = parseInt(color_price)+parseInt(main_price);

            $('input[name=price]').val(totalprice);
            $('#myprice').html(totalprice);

        });



        $(document).on('click', '.btn-add-cart', function (e) {

            e.preventDefault();
            var $this = $(this);
            var color = null;
            var colorItem = $('.select-color');
            // console.log(colorItem);
            if (colorItem.length > 0) {
                // if (!colorItem.hasClass('active')) {
                // if (!$(".select-color").prop("checked")) {
                //     $.notify("Select product color..!!", "error");
                //     return false;
                // }

                if ($('input[name=color]').is(':checked') == false ) {
                    $.notify("Select product color..!!", "error");
                    return false;
                }

                
                
            }

            if ($('input[name=size]').is(':checked') == false ) {
                    $.notify("Select product size..!!", "error");
                    return false;
            }

            $.ajax({
                type: 'get',
                url: "{{ route('get:add_to_cart') }}",
                data: $('#productInfo').serialize(),
                beforeSend: function () {
                    $this.html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                    $this.attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        $.notify(result.message, "success");
                        $this.html('Add to cart');
                        $this.attr('disabled', false);
                        getCart();
                    }
                    if (result.error == true) {
                        $.notify(result.message, "error");
                        $this.html('Add to cart');
                        $this.attr('disabled', false);
                    }
                }
            });
        });

        $(document).on('click', '.add-cart', function (e) {
            e.preventDefault();
            var $this = $(this);
            var slug = $this.attr('slug');
            $.ajax({
                type: 'get',
                url: "{{ route('get:add_to_cart') }}",
                data: {slug: slug},
                beforeSend: function () {
                    $this.html('<i style="margin-top: 10px;" class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                    $this.attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        $this.html('Add to cart');
                        $this.attr('disabled', false);
                        getCart();
                        $.notify(result.message, "success");
                    }
                    if (result.error == true) {
                        $.notify(result.message, "error");
                        $this.html('Add to cart');
                        $this.attr('disabled', false);
                    }
                }
            });
        });

        function getCart() {
            $.ajax({
                type: 'get',
                url: "{{ route('get:cart') }}",
                beforeSend: function () {
                    $(this).html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                    $(this).attr('disabled', true);
                },
                success: function (result) {
                    $('#cart-block').html(result);
                }
            });
        }

        $(window).scroll(function () {
            $('.compare-btn').addClass('fixed');
        });


        $('#related-product-view').owlCarousel({
            loop: true,
            nav: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        })


        // // ajax call for colors images
        // $(document).ready(function() {
        //     $('.select-color').click(function()
        //     {
               
        //         var slider = $('#lightSlider').lightSlider();
        //         var attribute_id = $(this).attr('attribute_id');
        //         $.ajax({
        //             type: 'get',
        //             url: "{{ route('get:color_images') }}",
        //             data: {'attribute_id': attribute_id,'slug':"{{ $product->slug }}"},
        //              dataType: "json",
        //             beforeSend: function () {
        //                 $(this).attr('disabled', true);
        //             },
        //             success: function (result) {
        //                  // $('#lightSlider').html(result);
        //                  // console.log(result);
        //                  // var baseurl= "{{ asset('100ProductImg/') }}";
        //                  // var newEl = ' <li class="lslide"> <a href="javascript:void(0)"><img src="'+image1+'/'+result.slides.image1+'" /></a> </li>';
        //                  //    slider.prepend(newEl);
        //                  //    // slider.refresh();
        //                  //    console.log(newEl);
                        
        //             }
        //         });
        //     }); 

        // });
    </script>
@endsection