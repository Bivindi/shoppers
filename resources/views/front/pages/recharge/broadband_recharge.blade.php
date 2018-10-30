<form class="abc" id="broadbandRecharge">
    {{ csrf_field() }}
    <input type="hidden" name="type" value="{{ \App\Model\RechargeHistory::BROADBAND }}">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-group">
                        <select class="form-control" id="sel5" name="operator" style="color: #000;">
                            <option value="">Select Operator</option>
                            @foreach($broadband as $item)
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
                        <input id="user_id" type="text" class="form-control" name="userId" placeholder="User ID">
                        <span class="error userId_error"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input id="number5" type="number" class="form-control" name="amount" placeholder="Enter Amount">
                        <span class="error amount_error"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary submitBtn" style="background-color:#0088cc;">
                        Proceed
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).on('submit', '#dataCardForm', function (e) {
        e.preventDefault();
        @if(Auth::check())
        $.ajax({
            type: 'post',
            url: "{{ route('post:datacard_recharge') }}",
            data: $(this).serialize(),
            beforeSend: function () {
                $(".submitBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                $(".submitBtn").attr('disabled', true);
            },
            success: function (result) {
                if (result.success == true) {
                    $('#defaultModal').modal('hide');
                    $('#dataCardForm')[0].reset();
                    $(".submitBtn").html('Proceed');
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
                    $(".submitBtn").html('Proceed');
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

    $("#dataCardForm").validate({
        rules: {
            userId: 'required',
            operator: 'required',
            amount: 'required',
        },
        //For custom messages
        messages: {
            recharge_num: "Please enter your mobile number..!",
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