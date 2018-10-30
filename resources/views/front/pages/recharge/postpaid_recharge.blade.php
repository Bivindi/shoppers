<form class="abc" id="postpaidRecharge">
    {{ csrf_field() }}
    <input type="hidden" name="type" value="{{ \App\Model\RechargeHistory::POSTPAIDRECHARGE }}">
    <div class="row">
        <div class="col-sm-12 recharge-feild">
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input id="mobile2" type="text" class="form-control" name="recharge_num"
                               placeholder="Mobile Number" max-length="10">
                        <span class="error recharge_num_error"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-group">
                        <select class="form-control operator" name="operator" style="color: #000;">
                            <option value="">Choose Operator</option>
                            @foreach($postpaid as $operator)
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
                        <input type="text" class="form-control" name="amount"
                               placeholder="Enter Recharge Amount" max-length="10">
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
        <div class="form-group">
            <div class="plans-details">

            </div>
        </div>
    </div>
</form>
<script>
    $(document).on('submit', '#postpaidRecharge', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: "{{ route('post:recharge') }}",
            data: $(this).serialize(),
            beforeSend: function () {
                $(".submitBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                $(".submitBtn").attr('disabled', true);
            },
            success: function (result) {
                if (result.success == true) {
                    $('#rechargeModal').modal('hide');
                    $('#postpaidRecharge')[0].reset();
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

    $(document).on('change', '.operator', function (e) {
        e.preventDefault();
        getRechargePlan();
    });

    $(document).on('change', '.circle', function (e) {
        e.preventDefault();
        getRechargePlan();
    });

    function getRechargePlan() {
        var operator = $('.operator').val();
        var circle = $('.circle').val();
        if (operator.length == 0) {
            return false;
        } else if (circle.length == 0) {
            return false;
        }
        $.ajax({
            type: 'get',
            url: "{{ route('get:recharge_plans') }}",
            data: {operator: operator, circle: circle},
            beforeSend: function () {
                $('.recharge-feild').removeClass('col-sm-12').addClass('col-sm-4');
                $(".plans-details").html('<div class="text-center" style="min-height: 300px;"><i class="fa fa-spinner fa-spin fa-2x text-center fa-fw"></i></div>');
            },
            success: function (result) {
                $('.plans-details').html(result);
                if (result.error == true) {
                    $.notify(result.message, "error");
                    $('.recharge-feild').removeClass('col-sm-4').addClass('col-sm-12');
                    $(".plans-details").html('');
                }
            }
        });
    }

    $("#postpaidRecharge").validate({
        rules: {
            operator: 'required',
            amount: {
                required: true,
                digits: true
            },
            recharge_num: {
                required: true,
                number: true
            },
            circle: 'required'
        },
        //For custom messages
        messages: {
            operator: "Please select your operator..!",
            circle: "Please select your circle..!",
            amount: {
                required: "Please enter amount",
                digits:"Please enter digit only"
            },
            recharge_num: {
                required: "Please enter your mobile number",
                number:"Please enter numbers only"
            }
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