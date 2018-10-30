@extends('front.layout.default')

@section('title')
    Order
@endsection
@section('page-css')
@endsection
@section('body-class')
    class="category-page"
@endsection
@section('page-content')
<section class="coupon-area">
        <div class="container-fluid custom-width">
            <div class="row">
                <div class="col-lg-12">
                    @foreach($productOrders as $key => $productOrder)
                    <div class="sin-coupon row no-gutters">
                        <div class="col-sm-3 col-lg-2 col-xl-2">
                            <div class="coupon-img">
                                @if($productOrder->status == \App\Model\RechargeHistory::SUCCESS)
                                <span class="new" style="background:freen;">SUCCESS</span>
                                @elseif($productOrder->status == \App\Model\RechargeHistory::PENDING)
                                <span class="new" style="background:blue;">PENDING</span>
                                @else
                                <span class="new" style="background:red;">FAIL</span>
                                @endif
                                
                                <a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                <img src="{{ asset('300ProductImg/'.$productOrder->product_img) }}" alt="">
                            </div>
                        </div>
                        <div class="col-sm-9 col-lg-6 col-xl-7">
                            <div class="coupon-content">
                                <div class="rating">
                                    <a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-star active-color" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                </div>
                                <h2>{{ $productOrder->name }}</h2>
                                <!--<p>IMPRESSIVE SOUND QUALITY IS THE ULTIOAL & assive the  noise isolating, NOT active noise the world it cancellation(ANC).</p>-->
                                @if($productOrder->status == \App\Model\RechargeHistory::SUCCESS)
                                <span class="price" style="color:green;">{{ $productOrder->quantity }} - Rs. {{ $productOrder->price * $productOrder->quantity  }}</span>
                                @elseif($productOrder->status == \App\Model\RechargeHistory::PENDING)
                                <span class="price" style="color:blue">{{ $productOrder->quantity }} - Rs. {{ $productOrder->price * $productOrder->quantity  }}</span>
                                @else
                                <span class="price" style="color:red">{{ $productOrder->quantity }} - Rs. {{ $productOrder->price * $productOrder->quantity  }}</span>
                                @endif
                                
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-4 col-xl-3">
                            <div class="coupon-code">
                               <div class="sav-coupon-wrap">
                                   <a class="sav-coupon" href="#" data-toggle="tooltip" data-placement="top" title="Save Coupon">
<i class="fa fa-star-o" aria-hidden="true"></i></a>
                               </div>
                               <!--  data-toggle="modal" data-target=".bd-example-modal-lg-product-1" -->
                                <button type="button" class="coupon-hcode" onclick="location.href = '{{ route('get:order_details', $productOrder->transaction_id) }}';">
                                     <span class="getcode">Invoice</span>
                                    <span class="hcode">FGGH</span>
                                </button>
                                <p>{{ \Carbon\Carbon::parse($productOrder->created_at)->format("D dS M 'y H:i A") }}</p>
                             </div>
                        </div>
                    </div>
                    @endforeach
                    
                    
                </div>
                {{ $productOrders->links() }}
            </div>
        </div>
</section>
@endsection
@section('page-js')
@endsection