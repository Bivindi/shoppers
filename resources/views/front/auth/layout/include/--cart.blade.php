<a class="cart-link" href="{{ route('get:order_page') }}">
    <span class="title">Shopping cart</span>
    <span class="total">@if(isset($cartCount)){{ $cartCount }} @else 0 @endif
        items - @if(isset($totalPrice)) {{ $totalPrice }} @endif <i class="fa fa-inr"></i></span>
    <span class="notify notify-left">@if(isset($cartCount)){{ $cartCount }} @else 0 @endif</span>
</a>
<div class="cart-block">
    <div class="cart-block-content">
        <h5 class="cart-title">@if(isset($cartCount)){{ $cartCount }} @else 0 @endif Items in my cart</h5>
        <div class="cart-block-list">
            <ul>
                @if(isset($cartDetails))
                    @foreach($cartDetails as $cartDetail)
                        <li class="product-info">
                            <div class="p-left">
                                <a href="{{ route('get:remove_cart_product', $cartDetail->slug) }}" class="remove_link"></a>
                                <a href="{{ route('get:product_detail', $cartDetail->slug) }}">
                                    <img class="img-responsive" src="{{ asset('productimg/'.$cartDetail->product_img) }}" alt="p10">
                                </a>
                            </div>
                            <div class="p-right">
                                <p class="p-name">{{ mb_strimwidth($cartDetail->name, 0, 20, '...') }}</p>
                                <p class="p-rice">{{ $cartDetail->price * $cartDetail->quantity }} <i class="fa fa-inr"></i></p>
                                <p class="p-rice">Quantity :{{ $cartDetail->quantity }}</p>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="toal-cart">
            <span>Total</span>
            <span class="toal-price pull-right">@if(isset($totalPrice)){{ $totalPrice }} @endif
                <i class="fa fa-inr"></i></span>
        </div>
        <div class="cart-buttons">
            <a href="{{ route('get:order_page') }}" class="btn-check-out">Checkout</a>
        </div>
    </div>
</div>