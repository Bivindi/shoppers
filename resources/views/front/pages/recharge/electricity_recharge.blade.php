<form class="abc" id="electricityRecharge">
    {{ csrf_field() }}
    <input type="hidden" name="type" value="{{ \App\Model\RechargeHistory::ELECTRICITY }}">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-group">
                        <select class="form-control" name="operator" style="color: #000;">
                            <option value="">Select Operator</option>
                            @foreach($electricity as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <span class="error operator_error"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input id="customer_num" type="number" class="form-control" name="customer_num"
                               placeholder="Customer Number">
                        <span class="error customer_num_error"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="number" class="form-control" name="amount"
                               placeholder="Enter Amount">
                        <span class="error amount_error"></span>
                    </div>
                </div>
            </div>
            <div class="input-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary" style="background-color:#0088cc;">Proceed
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).on('submit', '#electricityRecharge', function (e) {
        e.preventDefault();
        @if(Auth::check())
        $.ajax({
            type: 'post',
            url: "{{ route('post:electricity_recharge') }}",
            data: $(this).serialize(),
            beforeSend: function () {
                $(".submitBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                $(".submitBtn").attr('disabled', true);
            },
            success: function (result) {
                if (result.success == true) {
                    $('#defaultModal').modal('hide');
                    $('#electricityRecharge')[0].reset();
                    $(".submitBtn").html('Process to Recharge');
                    $(".submitBtn").attr('disabled', false);
                    window.location.href = result.url
                } else {
                    $.notify(result.message, "error");
                }
                if (result.error == true) {
                    $.each(result.message, function (index, error) {
                        var keys = Object.keys(result.message);
                        $('input[name="' + keys[0] + '"]').focus();
                        $('.' + index + '_error').html(error);
                    });
                    shakeRechargeModal();
                    $(".submitBtn").html('Process to Recharge');
                    $(".submitBtn").attr('disabled', false);
                }
            }
        });
        @else
        $('#defaultModal').modal('hide');
        $('#loginRegister').trigger('click');
        $.notify("Please login for recharge", "error");
        @endif
    });

    $("#electricityRecharge").validate({
        rules: {
            subscriber_id: 'required',
            operator: 'required',
            amount: 'required',
        },
        //For custom messages
        messages: {
            customer_num: "Please enter your customer number..!",
            operator: "Please select your operator..!",
            amount: "Please enter your amount..!",
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