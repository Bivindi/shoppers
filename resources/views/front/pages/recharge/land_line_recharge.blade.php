<form class="abc" id="landLineRecharge">
    {{ csrf_field() }}
    <input type="hidden" name="type" value="{{ \App\Model\RechargeHistory::LANDLINE }}">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-group">
                        <select class="form-control" name="operator" id="sel11" style="color: #000;">
                            <option value="">SELECT OPERATOR</option>
                            @foreach($landline as $operator)
                                <option value="{{ $operator->id }}">{{ $operator->name }}</option>
                            @endforeach
                        </select>
                        <span class="error provider_error"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input id="phone_num" type="text" class="form-control" name="phone_num"
                               placeholder="Phone number with STD code without starting 0">
                        <span class="error phone_num_error"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input id="number9" type="number" class="form-control" name="amount"
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
    $(document).on('submit', '#landLineRecharge', function (e) {
        e.preventDefault();
        @if(Auth::check())
        $.ajax({
            type: 'post',
            url: "{{ route('post:land_line_recharge') }}",
            data: $(this).serialize(),
            beforeSend: function () {
                $(".submitBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                $(".submitBtn").attr('disabled', true);
            },
            success: function (result) {
                if (result.success == true) {
                    $('#defaultModal').modal('hide');
                    $('#landLineRecharge')[0].reset();
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

    $("#landLineRecharge").validate({
        rules: {
            phone_num: 'required',
            operator: 'required',
            amount: 'required',
        },
        //For custom messages
        messages: {
            phone_num: "Please enter your phone number..!",
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