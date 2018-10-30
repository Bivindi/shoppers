<div id="user-info-top" class="user-info pull-right">
    @if(Auth::check())
        <div class="dropdown">
            <a class="current-open user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="javascript:void(0);" style="border-right:none;color:#fff">
                <span> @if(Auth::check()) Hello {{ Auth::user()->username }} @endif</span></a>
            <ul class="dropdown-menu mega_dropdown" role="menu">
                @if(Auth::check())
                    <li><a href="{{ route('get:user_profile') }}" onclick="location.href = '{{ route('get:user_profile') }}';">Profile</a></li>
                    <li><a href="{{ route('get:compare') }}">Compare</a></li>
                    <li><a href="{{ route('get:wish_list') }}">Wishlists <span class="wishlisted pull-right wishlist-count">{{ Auth::user()->wishlistedProductCount() }}</span></a></li>
                    <li><a href="{{ route('get:your_orders') }}">Order </a></li>
                    <li><a href="{{ route('get:wallet') }}">Wallet </a></li>
                    <li><a href="{{ route('get:user_logout') }}">Logout</a></li>
                @endif
            </ul>
        </div>
    @else
        <a href="javascript:void(0);" id="loginRegister"
           data-target=".login-register-form" style="border-right:none;color:#fff">Register/Login</a>
    @endif
</div>
<div class="modal fade login" id="loginModal">
    <div class="modal-dialog modal-md login animated">
        <div class="modal-content">

        </div>
    </div>
</div>
<style>
    @media screen and (max-width: 480px) {
    #user-info-top {text-align: center;}
    
}
</style>