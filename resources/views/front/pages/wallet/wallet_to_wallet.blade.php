<form id="walletToWalletForm">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12 dataprof" style="color: #908c8c;" id="wallet">
            <div class="col-sm-3 wallet-price">
                <span class="value">Rs @if(\Illuminate\Support\Facades\Auth::user()->wallet_amount){{ \Illuminate\Support\Facades\Auth::user()->wallet_amount }} @else
                        0 @endif</span><span class="text">Your Wallet Balance</span>
            </div>
            <div class="col-sm-3">
                <input maxlength="6" class="form-control input-md wallet-money" type="number" name="money" tabindex="0"
                       placeholder="Enter Amount to be Added in Wallet" aria-invalid="false">
                <span class="error money_error"></span>
            </div>
            <div class="col-sm-3">
                <input maxlength="10" class="form-control input-md wallet-money" name="mobile_num" type="number" tabindex="0"
                       placeholder="Enter transfer mobile number" aria-invalid="false">
                <span class="error mobile_num_error"></span>
            </div>
            <div class="col-sm-3">
                <button type="submit" class="wallet-money" id="walletToWalletBtn">Add
                    Wallet to Wallet
                </button>
            </div>
        </div>
    </div>
</form>