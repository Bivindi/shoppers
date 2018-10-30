@extends('front.auth.layout.default')
@section('title')
    Product
@endsection
@section('page-css')
    <style>
        .btn-add-cart {
            cursor: pointer;
        }

        .buttonqty {
            cursor: pointer !important;
        }

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

        /*.color-choose input[type="radio"]:checked + label span {*/
            /*background-image: url(https://designmodo.com/demo/product-page/images/check-icn.svg);*/
            /*background-repeat: no-repeat;*/
            /*background-position: center;*/
        /*}*/

        .color-choose input[type="radio"] + label span {
            border: 2px solid #FFFFFF;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        }

        .wishlist {
            cursor: pointer;
            background: #ff3366;
            border: 1px solid #ff3366;
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
                <span class="navigation_page">Compare</span>
            </div>
            <!-- ./breadcrumb -->
            <!-- page heading-->
            <h2 class="page-heading">
                <span class="page-heading-title2">Compare Products</span>
            </h2>
            <!-- ../page heading-->
            <div class="page-content">
                <table class="table table-bordered table-compare">
                    <tr>
                        <td class="compare-label">Product Image</td>
                        @foreach($compareProducts as $compareProduct)
                            <td>
                                <a href="{{ route('get:product_detail', $compareProduct->slug) }}"><img
                                            src="{{ asset('300ProdctImg/'.$compareProduct->product_img) }}"
                                            alt="Product"></a>
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="compare-label">Product Name</td>
                        @foreach($compareProducts as $compareProduct)
                            <td>
                                <a href="{{ route('get:product_detail', $compareProduct->slug) }}">{{ $compareProduct->name }}</a>
                            </td>
                        @endforeach
                    </tr>
                    {{--<tr>--}}
                        {{--<td class="compare-label">Rating</td>--}}
                        {{--<td>--}}
                            {{--<div class="product-star">--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star-half-o"></i>--}}
                                {{--<span>(3 Reviews)</span>--}}
                            {{--</div>--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--<div class="product-star">--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star"></i>--}}
                                {{--<i class="fa fa-star-half-o"></i>--}}
                                {{--<span>(3 Reviews)</span>--}}
                            {{--</div>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    <tr>
                        <td class="compare-label">Price</td>
                        @foreach($compareProducts as $compareProduct)
                            <td class="price">${{ $compareProduct->price }}</td>
                        @endforeach
                    </tr>
                  <!--  <tr>
                        <td class="compare-label">Description</td>
                        @foreach($compareProducts as $compareProduct)
                            <td>{!! mb_strimwidth($compareProduct->desc, 0, 50, '...') !!}
                            </td>
                        @endforeach
                    </tr> -->
                    <tr>
                        <td class="compare-label">Manufacturer</td>
                        @foreach($compareProducts as $compareProduct)
                            <td>{{ $compareProduct->getBrandName() }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="compare-label">Availability</td>
                        @foreach($compareProducts as $compareProduct)
                            <td class="instock">@if($compareProduct->quantity != 0)Instock
                                ({{ $compareProduct->quantity }} items) @else Out of stock @endif
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="compare-label">SKU</td>
                        @foreach($compareProducts as $compareProduct)
                            <td>{{ $compareProduct->sku }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="compare-label">Color</td>
                        @foreach($compareProducts as $product)
                            <td>
                                <div class="color-choose">
                                    @foreach($product->productColors() as $item)
                                        <div>
                                            <input type="radio" class="select-color" id="{{ $item->desc }}"
                                                   name="color"
                                                   value="{{ $item->desc }}">
                                            <label for="{{ $item->desc }}"><span
                                                        style="background-color: {{ $item->desc }}"></span></label>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="compare-label">Size</td>
                        @foreach($compareProducts as $product)
                            <td>
                                @if(count($product->productSize())>0)
                                    <select name="size">
                                        @foreach($product->productSize() as $item)
                                            <option value="{{ $item->desc }}">{{ $item->desc }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="compare-label">Product Attributes</td>
                        @foreach($compareProducts as $product)
                            <td>
                                @foreach($product->productAttributes() as $item)
                                    {{ $item->name. ' => '. $item->desc }}
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="compare-label">Action</td>
                        @foreach($compareProducts as $compareProduct)
                            <td class="action">
                                {{--<button class="add-cart button button-sm addToCart"--}}
                                {{--productId="{{ $compareProduct->product_id }}">Add to cart--}}
                                {{--</button>--}}
                                <button class="button button-sm addWishlist @if($compareProduct->checkWishlisted()) wishlist @endif"
                                        productId="{{ $compareProduct->product_id }}"><i class="fa fa-heart-o"></i>
                                </button>
                                <button class="button button-sm removeCompare"
                                        productId="{{ $compareProduct->product_id }}"><i class="fa fa-close"></i>
                                </button>
                            </td>
                        @endforeach
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script>
        $(document).on('click', '.addWishlist', function (e) {
            e.preventDefault();
            var wishlist = $(this);
            var productId = $(this).attr('productId');
            @if(Auth::check())
            $.ajax({
                type: 'get',
                url: "{{ route('get:add_to_wishlist') }}",
                data: {productId: productId},
                beforeSend: function () {
                    $(this).attr('disabled', true);
                },
                success: function (result) {
                    if (result.success == true) {
                        wishlist.attr('disabled', false);
                        if (result.added == 1) {
                            wishlist.addClass('wishlist');
                        } else {
                            wishlist.removeClass('wishlist');
                        }
                        $.notify(result.message, "success");
                    }
                    if (result.error == true) {
                        $.notify(result.message, "error");
                    }
                }
            });
            @else
            openLoginModal();
            $.notify("Please login for wishlisting a product", "error");
            @endif
        });

        $(document).on('click', '.removeCompare', function (e) {
            e.preventDefault();
            var wishlist = $(this);
            var productId = $(this).attr('productId');
            $.ajax({
                type: 'get',
                url: "{{ route('get:remove_from_compare') }}",
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