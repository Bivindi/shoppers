<form class="abc" id="dthRecharge" action="{{ route('post:dth_recharge') }}">
    {{ csrf_field() }}
    <input type="hidden" name="type" value="{{ \App\Model\RechargeHistory::DTHRECHARGE }}">
    <div class="row">
        <div class="col-sm-12 recharge-feild">
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input id="subscriber_id" type="text" class="form-control" name="subscriber_id"
                               placeholder="Subscriber ID/Customer ID">
                        <span class="error subscriber_id_error"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-group">
                        <select class="form-control" name="operator" id="sel4" style="color: #000;">
                            <option value="">Choose Operator</option>
                            @foreach($dth as $operator)
                                <option value="{{ $operator->id }}">{{ $operator->name }}</option>
                            @endforeach
                        </select>
                        <span class="error operator_error"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-group">
                        <select class="form-control circle" name="circle" title="Circle" style="color: #000;">
                            <option value="">SELECT CIRCLE</option>
                            @foreach($circles as $circle)
                                <option value="{{ $circle->id }}">{{ $circle->name }}</option>
                            @endforeach
                            <span class="error circle_error"></span>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input id="number4" type="number" class="form-control" name="amount"
                               placeholder="Enter Recharge Amount">
                        <span class="error amount_error"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary submitBtn" style="background-color:#0088cc;">Process
                        to Recharge
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).on('submit', '#dthRecharge', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: "{{ route('post:dth_recharge') }}",
            data: $(this).serialize(),
            beforeSend: function () {
                $(".submitBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                $(".submitBtn").attr('disabled', true);
            },
            success: function (result) {
                if (result.success == true) {
                    $('#defaultModal').modal('hide');
                    $('#dthRecharge')[0].reset();
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
    });

    $("#dthRecharge").validate({
        rules: {
            subscriber_id: 'required',
            operator: 'required',
            amount: 'required',
            circle: 'required'
        },
        //For custom messages
        messages: {
            subscriber_id: "Please enter your subscriber id or customer id..!",
            operator: "Please select your operator..!",
            amount: "Please enter your amount..!",
            circle: "Please select your circle..!",
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