<form class="abc" id="gasRecharge">
    {{ csrf_field() }}
    <input type="hidden" name="type" value="{{ \App\Model\RechargeHistory::GAS }}">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-group">
                        <select class="form-control" name="provider" style="color: #000;">
                            <option value="">Select Provider</option>
                            @foreach($gas as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <span class="error provider_error"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input id="customer_id_num" type="text" class="form-control"
                               name="customer_id_num" placeholder="Customer ID Number">
                        <span class="error customer_id_num_error"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input id="number7" type="number" class="form-control" name="amount"
                               placeholder="Amount">
                        <span class="error amount_error"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary submitBtn" style="background-color:#0088cc;">Proceed
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).on('submit', '#gasRecharge', function (e) {
        e.preventDefault();
        @if(Auth::check())
        $.ajax({
            type: 'post',
            url: "{{ route('post:gas_recharge') }}",
            data: $(this).serialize(),
            beforeSend: function () {
                $(".submitBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                $(".submitBtn").attr('disabled', true);
            },
            success: function (result) {
                if (result.success == true) {
                    $('#defaultModal').modal('hide');
                    $('#gasRecharge')[0].reset();
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

    $("#gasRecharge").validate({
        rules: {
            customer_id_num: 'required',
            operator: 'required',
            amount: 'required',
        },
        //For custom messages
        messages: {
            customer_id_num: "Please enter your customer id number..!",
            provider: "Please select your provider..!",
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