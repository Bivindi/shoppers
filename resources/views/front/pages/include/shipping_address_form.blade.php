<form id="shippingAddressForm">
    {{ csrf_field() }}
    <div class="row">
        <div class="form-group">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="first_name_1" class="required">First Name</label>
                    <input class="input form-control" type="text" name="first_name"
                           id="first_name_1">
                    <span class="error first_name_error"></span>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="last_name_1" class="required">Last Name</label>
                    <input class="input form-control" type="text" name="last_name" id="last_name_1">
                    <span class="error last_name_error"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="city_1" class="required">City</label>
                    <input class="input form-control" type="text" name="city" id="city_1">
                    <span class="error city_error"></span>
                </div>
            </div><!--/ [col] -->
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="state" class="required">State</label>
                    <input type="text" id="state" name="state" class="input form-control">
                    <span class="error state_error"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="postal_code_1" class="required">Pin Code</label>
                    <input class="input form-control" type="text" name="pin_code"
                           id="postal_code_1">
                    <span class="error pin_code_error"></span>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="telephone_1" class="required">Mobile Number</label>
                    <input class="input form-control" type="number" name="mobile_num"
                           id="telephone_1">
                    <span class="error mobile_num_error"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="input form-control" type="text" name="address"
                              id="address">{{ old('address') }}</textarea>
                    <span class="error address_error"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <div class="col-sm-12" style="margin-top: 15px;">
                <button type="submit" class="button shippingBtn">Continue</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {
        $.get("https://ipinfo.io/json", function (response) {
            $("#state").val(response.region);
            $("#city_1").val(response.city);
            $("#postal_code_1").val(response.postal);
            // $("#details").html(JSON.stringify(response, null, 4));
        });
    });

    jQuery.validator.addMethod("pincode", function (value, element) {
        return this.optional(element) || /\b\d{6}\b/.test(value);
    }, "Please provide a valid pin code.");

    $("#shippingAddressForm").validate({
        rules: {
            first_name: 'required',
            last_name: 'required',
            city: 'required',
            state: 'required',
            'pin_code': {
                required: true,
                pincode: true // <-- use it like this
            },
            address: 'required',
            mobile_num: {
                required: true,
                minlength: 9,
                maxlength: 10,
                number: true
            }
        },
        //For custom messages
        messages: {
            first_name: "Please enter your first name..!",
            last_name: "Please enter your last name..!",
            city: "Please enter your city..!",
            state: "Please enter your state..!",
            address: "Please enter your address..!",
            mobile_num: "Please enter your mobile number..!",
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
</script>
