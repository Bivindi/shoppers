<form class="abc" id="dataCardForm">
    {{ csrf_field() }}
    <input type="hidden" name="type" value="{{ \App\Model\RechargeHistory::DATACARD }}">
    <div class="row">
        <div class="col-sm-12 recharge-feild">
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input id="datacard" type="text" class="form-control" name="datacard"
                               placeholder="Enter DataCard Number">
                        <span class="error datacard_error"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="form-group">
                        <select class="form-control operator" id="sel31" name="operator"
                                style="color: #000;">
                            <option value="">Choose Operator</option>
                            @foreach($dataCard as $operator)
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
                        <select class="form-control circle" name="circle" id="sel12"
                                title="Circle" style="color: #000;">
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
                        <input id="number3" type="number" class="form-control amount" name="amount"
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

    $(document).on('click', '.plans', function () {
        var val = parseInt($(this).attr('price'));
        if (val != 0) {
            $('.amount').attr('value', '');
            $('.amount').val(val);
        }
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
        var circle = $('.circle').val();
        var operator = $('.operator').val();
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
                }
            }
        });
    }

    $("#dataCardForm").validate({
        rules: {
            datacard: 'required',
            operator: 'required',
            amount: 'required',
            circle: 'required'
        },
        //For custom messages
        messages: {
            datacard: "Please enter your mobile number..!",
            operator: "Please select your operator..!",
            amount: "Please enter your amount..!",
            circle: "Please select your circle..!"
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