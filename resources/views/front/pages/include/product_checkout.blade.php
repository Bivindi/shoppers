@if(count($products)>0)
    <table class="table table-bordered table-responsive cart_summary">
        <thead>
        <tr>
            <th class="cart_product">Product</th>
            <th>Description</th>
            <th>Avail.</th>
            <th>Unit price</th>
            <th>Qty</th>
            <th>Total</th>
            <th class="action"><i class="fa fa-trash-o"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td class="cart_product">
                    <a href="{{ route('get:product_detail', $product->slug) }}"><img
                                src="{{ asset('100ProductImg/'.$product->product_img) }}"
                                alt="Product"></a>
                </td>
                <td class="cart_description">
                    <p class="product-name"><a
                                href="{{ route('get:product_detail', $product->slug) }}">{{ $product->name }} </a></p>
                </td>
                <td class="cart_avail"><span class="label label-success">@if($product->quantity != 0)
                            In stock @else Not In Stock @endif</span></td>
                <td class="price"><span>{{ $product->price }}<i
                                class="fas fa-rupee-sign"></i></span>
                </td>

                <td class="qty">
                    <div class="attribute-list product-qty">
                        <div class="qty">
                            <input id="product-qty{{ $product->cart_quantity }}" type="text" min="1"
                                   name="product_qty" class="quantity" max="{{ $product->cart_quantity }}"
                                   value="{{ $product->cart_quantity }}">
                        </div>
                        <div class="btn-plus">
                            <a href="javascript:void(0);" class="btn-plus-up buttonqty" cartId="{{ $product->cartId }}">
                                <i class="fa fa-caret-up"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn-plus-down buttonqty"
                               cartId="{{ $product->cartId }}">
                                <i class="fa fa-caret-down"></i>
                            </a>
                        </div>
                    </div>
                </td>
                <td class="price">
                    <span>{{ $product->price * $product->cart_quantity }} <i class="fa fa-inr"></i></span>
                </td>
                <td class="action">
                    <a href="{{ route('get:remove_cart_product', $product->slug) }}"><i class="fa fa-trash-o"></i>
                        Delete item</a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="2" rowspan="2"></td>
            <td colspan="3">Total products (tax incl.)</td>
            <td colspan="2">@if(Auth::check()){{ $product->AuthTotalPrice() }} @else {{ $product->getTotal() }} @endif
                <i class="fa fa-inr"></i>
            </td>
        </tr>
        <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td colspan="2">
                <strong><span class="totalPrice"
                              total="@if(Auth::check()){{ $product->AuthTotalPrice() }} @else {{ $product->getTotal() }}@endif">@if(Auth::check()){{ $product->AuthTotalPrice() }} @else {{ $product->getTotal() }}@endif</span>
                    <i class="fa fa-inr"></i></strong></td>
        </tr>
        </tfoot>
    </table>
@else
    <div class="ecart">
        <h1>Your Shopping Bag is Empty!</h1>
        <div class="col-sm-4 col-sm-offset-4">
            <a class="continue-btn" href="{{ route('get:homepage') }}">Continue shopping</a>
        </div>
    </div>
@endif