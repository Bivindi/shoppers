<div class="authentication">
    <h3>Edit Profile</h3>
    <form id="userProfilForm">
        {{ csrf_field() }}
        <div class="form-group row">
            <div class="col-sm-6">
                <label for="first_name">First Name</label>
                <input id="first_name" type="text" name="first_name" value="{{ Auth::user()->first_name }}"
                       class="form-control">
                <span class="first_name_error error"></span>
            </div>
            <div class="col-sm-6">
                <label for="last_name">Last Name</label>
                <input id="last_name" type="text" name="last_name" value="{{ Auth::user()->last_name }}"
                       class="form-control">
                <span class="last_name_error error"></span>
            </div>
            <div class="col-sm-6">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ Auth::user()->email }}" class="form-control">
                <span class="email_error error"></span>
            </div>
            <div class="col-sm-6">
                <label for="mobile">Mobile No.</label>
                <input id="mobile" type="number" name="mobile_num" value="{{ Auth::user()->mobile_num }}"
                       class="form-control">
                <span class="mobile_num_error error"></span>
            </div>
            <div class="col-sm-6">
                <label for="states">State</label>
                <select name="state" id="states" class="form-control">
                    @foreach($states as $state)
                        {{ $selected = (Auth::user()->state == $state->name) ? 'selected' : '' }}
                        <option value="{{ $state->code }}" {{ $selected }}>{{ $state->name }}</option>
                    @endforeach
                </select>
                <span class="state_error error"></span>
            </div>
            <div class="col-sm-6">
                <label for="city">City</label>
                <select name="city" id="city" class="form-control">
                    @foreach($stateCity as $city)
                        {{ $selected = (Auth::user()->city == $city->name) ? 'selected' : '' }}
                        <option value="{{ $city->id }}" {{ $selected }}>{{ $city->name }}</option>
                    @endforeach
                </select>
                <span class="city_error error"></span>
            </div>
            <div class="col-sm-6">
                <label for="datepicker">Date Of Birth</label>
                <input id="date" type="text" value="{{ Auth::user()->birth_date }}"
                       name="birth_date" class="form-control">
                <span class="birth_date_error error"></span>
            </div>
            <div class="col-sm-6">
                <label for="states">Gender</label>
                <br>
                <label class="radio-inline">
                    <input type="radio" name="gender" @if(Auth::user()->gender == 'male') checked @endif value="male">Male
                </label>
                <span class="gender_error error"></span>
                <label class="radio-inline">
                    <input type="radio" name="gender" @if(Auth::user()->gender == 'female') checked
                           @endif value="female">Female
                </label>
                <span class="gender_error error"></span>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <button type="submit" class="button submitBtn" style="width: 100%;"><i class="fa fa-submit"></i> Update</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script>
    // The date picker (read the docs)
    $(document).ready(function () {
        var date_input = $('#date'); //our date input has the name "date"
        date_input.datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            autoclose: true,
        })
    });

    $(document).on('submit', '#userProfilForm', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: "{{ route('post:user_profile') }}",
            data: $(this).serialize(),
            beforeSend: function () {
                $(".submitBtn").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>');
                $(".submitBtn").attr('disabled', true);
            },
            success: function (result) {
                if (result.success == true) {
                    if (result.success == true) {
                        window.location.reload();
                    }
                }
                if (result.error == true) {
                    $.each(result.message, function (index, error) {
                        var keys = Object.keys(result.message);
                        $('input[name="' + keys[0] + '"]').focus();
                        $('.' + index + '_error').html(error);
                    });
                    $(".submitBtn").html('Update');
                    $(".submitBtn").attr('disabled', false);
                }
            }
        });
    });
</script>