@extends('front.auth.layout.default')
@section('title')
    WishList
@endsection
@section('page-css')
    <style>
        .price {
            font-size: 22px;
            display: inline-block;
            vertical-align: middle;
        }

        .wishlist {
            cursor: pointer;
        }

        ._210VZM {
            padding-top: 100px;
            text-align: center;
        }

        ._210VZM ._3Lk2d2 {
            display: block;
            font-size: 20px;
            font-weight: 500;
            margin-top: 30px;
        }

        ._210VZM ._3uF3Z6 {
            display: block;
            font-size: 14px;
            margin-top: 8px;
        }
    </style>
@endsection
@section('body-class')
    class="product-page"
@endsection
@section('page-content')
    <div class="columns-container">
        <div class="container" id="columns">
            <!-- breadcrumb -->
            <div class="breadcrumb clearfix">
                <a class="home" href="#" title="Return to Home">Home</a>
                <span class="navigation-pipe">&nbsp;</span>
                <a href="#" title="Return to Home">My account</a>
                <span class="navigation-pipe">&nbsp;</span>
                <span class="navigation_page">My wishlist</span>
            </div>
            <!-- ./breadcrumb -->
            <!-- row -->
            <div class="row">
                <!-- Left colunm -->
                <div class="column col-xs-12 col-sm-3" id="left_column">
                    <!-- block best sellers -->
                    <div class="block left-module">
                        <p class="title_block">New products</p>
                        <div class="block_content">
                            <ul class="products-block best-sell">
                                <li>
                                    <div class="products-block-left">
                                        <a href="#">
                                            <img src="{{ asset('front/') }}/assets/data/product-100x122.jpg"
                                                 alt="SPECIAL PRODUCTS">
                                        </a>
                                    </div>
                                    <div class="products-block-right">
                                        <p class="product-name">
                                            <a href="#">Woman Within Plus Size Flared</a>
                                        </p>
                                        <p class="product-price">$38,95</p>
                                        <p class="product-star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="products-block-left">
                                        <a href="#">
                                            <img src="{{ asset('front/') }}/assets/data/p11.jpg" alt="SPECIAL PRODUCTS">
                                        </a>
                                    </div>
                                    <div class="products-block-right">
                                        <p class="product-name">
                                            <a href="#">Woman Within Plus Size Flared</a>
                                        </p>
                                        <p class="product-price">$38,95</p>
                                        <p class="product-star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="products-block-left">
                                        <a href="#">
                                            <img src="{{ asset('front/') }}/assets/data/p12.jpg" alt="SPECIAL PRODUCTS">
                                        </a>
                                    </div>
                                    <div class="products-block-right">
                                        <p class="product-name">
                                            <a href="#">Plus Size Rock Star Skirt</a>
                                        </p>
                                        <p class="product-price">$38,95</p>
                                        <p class="product-star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- ./block best sellers  -->

                    <!-- left silide -->
                    <div class="col-left-slide left-module">
                        <ul class="owl-carousel owl-style2" data-loop="true" data-nav="false" data-margin="0"
                            data-autoplayTimeout="1000" data-autoplayHoverPause="true" data-items="1"
                            data-autoplay="true">
                            <li><a href="#"><img src="{{ asset('front/') }}/assets/data/slide-left.jpg"
                                                 alt="slide-left"></a></li>
                            <li><a href="#"><img src="{{ asset('front/') }}/assets/data/slide-left2.jpg"
                                                 alt="slide-left"></a></li>
                            <li><a href="#"><img src="{{ asset('front/') }}/assets/data/slide-left3.png"
                                                 alt="slide-left"></a></li>
                        </ul>
                    </div>
                    <!--./left silde-->
                    <!-- block best sellers -->
                    <div class="block left-module">
                        <p class="title_block">ON SALE</p>
                        <div class="block_content product-onsale">
                            <ul class="product-list owl-carousel" data-loop="true" data-nav="false" data-margin="0"
                                data-autoplayTimeout="1000" data-autoplayHoverPause="true" data-items="1"
                                data-autoplay="true">
                                <li>
                                    <div class="product-container">
                                        <div class="left-block">
                                            <a href="#">
                                                <img class="img-responsive" alt="product"
                                                     src="{{ asset('front/') }}/assets/data/product-260x317.jpg"/>
                                            </a>
                                            <div class="price-percent-reduction2">-30% OFF</div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Maecenas consequat mauris</a></h5>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                            <div class="content_price">
                                                <span class="price product-price">$38,95</span>
                                                <span class="price old-price">$52,00</span>
                                            </div>
                                        </div>
                                        <div class="product-bottom">
                                            <a class="btn-add-cart" title="Add to Cart" href="#add">Add to Cart</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="product-container">
                                        <div class="left-block">
                                            <a href="#">
                                                <img class="img-responsive" alt="product"
                                                     src="{{ asset('front/') }}/assets/data/p35.jpg"/>
                                            </a>
                                            <div class="price-percent-reduction2">-10% OFF</div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Maecenas consequat mauris</a></h5>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                            <div class="content_price">
                                                <span class="price product-price">$38,95</span>
                                                <span class="price old-price">$52,00</span>
                                            </div>
                                        </div>
                                        <div class="product-bottom">
                                            <a class="btn-add-cart" title="Add to Cart" href="#add">Add to Cart</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="product-container">
                                        <div class="left-block">
                                            <a href="#">
                                                <img class="img-responsive" alt="product"
                                                     src="{{ asset('front/') }}/assets/data/p37.jpg"/>
                                            </a>
                                            <div class="price-percent-reduction2">-42% OFF</div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="#">Maecenas consequat mauris</a></h5>
                                            <div class="product-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-o"></i>
                                            </div>
                                            <div class="content_price">
                                                <span class="price product-price">$38,95</span>
                                                <span class="price old-price">$52,00</span>
                                            </div>
                                        </div>
                                        <div class="product-bottom">
                                            <a class="btn-add-cart" title="Add to Cart" href="#add">Add to Cart</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- ./block best sellers  -->
                    <div class="block left-module">
                        <p class="title_block">SPECIAL PRODUCTS</p>
                        <div class="block_content">
                            <ul class="products-block">
                                <li>
                                    <div class="products-block-left">
                                        <a href="#">
                                            <img src="{{ asset('front/') }}/assets/data/product-100x122.jpg"
                                                 alt="SPECIAL PRODUCTS">
                                        </a>
                                    </div>
                                    <div class="products-block-right">
                                        <p class="product-name">
                                            <a href="#">Woman Within Plus Size Flared</a>
                                        </p>
                                        <p class="product-price">$38,95</p>
                                        <p class="product-star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                            <div class="products-block">
                                <div class="products-block-bottom">
                                    <a class="link-all" href="#">All Products</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./left colunm -->
                <!-- Center colunm-->
                <div class="center_column col-xs-12 col-sm-9" id="center_column">
                    <!-- page heading-->
                    <h2 class="page-heading">
                        <span class="page-heading-title2">My wishlist</span>
                    </h2>
                    @if(count($wishlists)>0)
                        <ul class="row list-wishlist">
                            @foreach($wishlists as $product)
                                <li class="col-sm-3">
                                    <div class="product-img">
                                        <a href="#"><img
                                                    src="{{ asset('268ProductImg/'.$product->product_img) }}"
                                                    alt="Product"></a>
                                    </div>
                                    <div class="pull-left">
                                        <h5 class="product-name">
                                            <a href="{{ route('get:product_detail', $product->slug) }}">{{ $product->name }}</a>
                                        </h5>
                                        <div class="qty">
                                            <span class="price">₹ {{ $product->price }}</span>
                                            <a class="wishlist price pull-right" productId="{{ $product->id }}"><i
                                                        class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="_1GRhLX HOy7kc">
                            <div class="_210VZM"><img
                                        src="{{ asset('/') }}img/mywishlist-empty.png"><span
                                        class="_3Lk2d2">Empty Wishlist</span><span class="_3uF3Z6">You have no items in your wishlist. Start adding!</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script>
        $(document).on('click', '.wishlist', function (e) {
            e.preventDefault();
            var wishlist = $(this);
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
                        location.reload();
                    }
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            });
        });
    </script>
@endsection