<div class="product-tab">
    <ul class="nav-tab">
        <li class="active">
            <a aria-expanded="false" data-toggle="tab" href="#product-detail">Product
                Details</a>
        </li>
        <li>
            <a aria-expanded="true" data-toggle="tab" href="#information">information</a>
        </li>
        <li>
            <a data-toggle="tab" href="#reviews">reviews</a>
        </li>
    </ul>
    <div class="tab-container">
        <div id="product-detail" class="tab-panel active">
            {!! $product->desc !!}
        </div>
        <div id="information" class="tab-panel">
            <table class="table table-bordered">
                @foreach($product->ProductAttributes()->where('name', '!=', 'color')->where('name', '!=', 'size')->select('name', 'desc')->get() as $productAttribute)
                    <tr>
                        <td width="200">{{ $productAttribute->name }}</td>
                        <td>{{ $productAttribute->desc }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div id="reviews" class="tab-panel">
            <div class="product-comments-block-tab">
                <div class="comment row">
                    @foreach($productReviews as $productReview)
                        <div class="col-sm-3 author">
                            <div class="grade">
                                <span>Grade</span>
                                <span class="ratiyo-rating" data-rating="{{ $productReview->rating }}"></span>
                            </div>
                            <div class="info-author">
                                <span><strong>{{ $productReview->username }}</strong></span>
                                <em>{{ \Carbon\Carbon::parse($productReview->created_at)->format('d/m/Y') }}</em>
                            </div>
                        </div>
                        <div class="col-sm-9 commnet-dettail">
                            {{ $productReview->desc }}
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p></p>
                        <a class="btn-comment" productId="{{ $product->id }}" href="javascript:void(0);">Write your
                            review
                            !</a>
                    </div>
                </div>
                <div class="reviewForm">
                </div>
            </div>
        </div>
    </div>
</div>