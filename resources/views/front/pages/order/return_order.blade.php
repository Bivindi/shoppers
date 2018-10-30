<style>
    ._3PqwaQ {
        padding-right: 8px;
    }

    ._3Vj7el {
        color: #878787;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .color {
        border: 2px solid #FFFFFF;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        display: inline-block;
        width: 20px;
        height: 20px;
        margin: -1px 4px 0 0;
        vertical-align: middle;
        cursor: pointer;
        border-radius: 50%;
    }

    .reason {
        padding-bottom: 10px;
        padding-top: 10px;
    }

    ._1WJhNj {
        width: 100%;
        height: 50px;
        font-family: inherit;
        overflow-x: auto;
        resize: none;
        font-size: 14px;
        padding: 5px 6px;
        border: 1px solid #d7d7d7;
        border-radius: 4px;
    }

    #btn-cancel {
        font-size: 14px;
        line-height: 18px;
        color: white;
        padding: 0;
        font-weight: normal;
        background: #666;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
        border: none;
        padding: 15px 25px;
        margin-top: 5px;
    }

    #btn-cancel:hover {
        background: #F36;
    }
</style>
<form id="returnForm">
    {{ csrf_field() }}
    <input type="text" name="transId" value="{{ $productOrder->transaction_id }}">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ITEM DETAILS</th>
            <th scope="col">QTY</th>
            <th scope="col">SUBTOTAL</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <div class="col-sm-3">
                    <div style="height: 75px; width: 75px;">
                        <img src="{{ asset('100ProductImg/'.$productOrder->product_img) }}" alt="">
                    </div>
                </div>
                <div class="col-sm-8">
                    <a class="_2AkmmA  NPoy5u"
                       href="{{ route('get:product_detail', $productOrder->slug) }}"
                       target="_blank">{{ $productOrder->name }}</a>
                    <span class="_3PqwaQ">
                    <span class="_3Vj7el">Color: </span>
                    <label><span class="color" style="background-color: #0088cc"></span></label>

                <span class="_3PqwaQ"><span class="_3Vj7el">Size: </span><span
                            class="_14N9bh">{{ $productOrder->size }}</span>
                </span>
                </span>
                </div>
            </td>
            <td>{{ $productOrder->quantity }}</td>
            <td>{{ $productOrder->price }}</td>
        </tr>
        </tbody>
    </table>
    <hr>
    <p class="reason">Reason for return</p>
    <select class="form-control" name="reasonList">
        <option value="">Select reason</option>
        <option value="long_delivery_promise">Expected delivery time is too long</option>
        <option value="purchased_mistake">Order placed by mistake</option>
        <option value="others">My reason is not listed</option>
        <option value="expensive_now">Item Price/shipping cost is too high</option>
        <option value="delivery_delayed">The delivery is delayed</option>
        <option value="change_ship_address">Need to change shipping address</option>
        <option value="purchased_elsewhere">Bought it from somewhere else</option>
    </select>
    <p class="reason">
        Comments
    </p>
    <textarea maxlength="1000" name="comments" class="_1WJhNj"></textarea>
    <div class="col-sm-12">
        <div class="row"><strong>Note: </strong><span class="_1scjlp">There will be no refund as the order is purchased using Cash-On-Delivery</span>
        </div>
    </div>
    <button type="submit" id="btn-cancel" class="btn">CONFIRM RETURN</button>
</form>
<script type="text/javascript" src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script>
    $(document).on('submit', '#returnForm', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: "{{ route('post:order_return') }}",
            data: $(this).serialize(),
            beforeSend: function () {
                $("#btn-cancel").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw text-center"></i>');
                $("#btn-cancel").attr('disabled', true);
            },
            success: function (result) {
                if(result.success == true){
                    location.reload();
                }
                if (result.error == true) {
                    $.each(result.message, function (index, error) {
                        var keys = Object.keys(result.message);
                        $('input[name="' + keys[0] + '"]').focus();
                        $('.' + index + '_error').html(error);
                    });
                    $("#btn-cancel").html('CONFIRM RETURN');
                    $("#btn-cancel").attr('disabled', false);
                }

                if(result.success == false){
                    $.notify(result.message, "error");
                    $("#btn-cancel").html('CONFIRM RETURN');
                    $("#btn-cancel").attr('disabled', false);
                }
            }
        });
    });

    $("#returnForm").validate({
        rules: {
            reasonList: 'required',
        },
        //For custom messages
        messages: {
            reasonList: "Please select reasonList..!",
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error);
                $(".submitBtn").addClass('shakeBtn');
            } else {
                error.insertAfter(element);
                $(".submitBtn").addClass('shakeBtn');
            }
        }
    });
</script>
