<form id="ratingForm">
    {{ csrf_field() }}
    <input type="hidden" class="ratingValue" name="rating" value="@if(isset($productReview)){{ $productReview->rating }}@endif">
    <input type="hidden" name="productId" value="{{ $order->product_id }}">
    @if(isset($productReview))
        <input type="hidden" name="reviewId" value="{{ $productReview->id }}">
    @endif
    <div class="comment row">
        <div class="col-sm-12 rate-product">
            <h4>Rate this product</h4>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <div id="rateYo" data-rating="@if(isset($productReview)) {{ $productReview->rating }} @else 0 @endif"></div>
                <span class="error rating_error"></span>
            </div>
            <div class="form-selector">
                <label>Review Title</label>
                <input type="text" class="form-control input-sm"
                       value="@if(isset($productReview)) {{ $productReview->title }} @endif" name="title">
            </div>
            <div class="form-selector">
                <label>Description</label>
                <textarea class="form-control input-sm" name="desc"
                          rows="5">@if(isset($productReview)) {{ $productReview->desc }} @endif</textarea>
                <span class="error desc_error"></span>
            </div>
            <div class="form-selector">
                <button type="submit" id="btn-send-review" class="btn">Submit</button>
            </div>
        </div>
    </div>
</form>
<script>
    var rating = $('#rateYo').attr("data-rating");
    $(function () {
        $("#rateYo").rateYo({
            rating: rating,
            fullStar: true,
            spacing: "10px",
            multiColor: {

                "startColor": "#FF0000", //RED
                "endColor": "#ffe11b"  //GREEN
            }
        });
    });

    $(function () {
        $("#rateYo").rateYo().on("rateyo.change", function (e, data) {

            var rating = data.rating;
            $('.ratingValue').val(rating);
        });
    });

    $("#ratingForm").validate({
        rules: {
            desc: 'required'
        },
        //For custom messages
        messages: {
            desc: "Description cannot be empty..!"
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        }
    });
</script>