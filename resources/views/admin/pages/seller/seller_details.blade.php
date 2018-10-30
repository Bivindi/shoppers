<div class="row">
    <div class="col s12">
        <div class="col s6">
            <p><b>First Name :</b> {{ $user->first_name }}</p>
        </div>
        <div class="col s6">
            <p><b>Last Name :</b> {{ $user->last_name }}</p>
        </div>
        <div class="col s6">
            <p><b>Username :</b> {{ $user->username }}</p>
        </div>
        <div class="col s6">
            <p><b>Email :</b> {{ $user->email }}</p>
        </div>
        <div class="col s6">
            <p><b>Status :</b> @if($user->confirmed == 1) confirmed @else not confirmed @endif</p>
        </div>
        <div class="col s6">
            <p><b>Aadhar Number :</b> {{ $user->aadhar_num }}</p>
        </div>
        <div class="col s6">
            <p><b>GST Number :</b> {{ $user->gst_num }}</p>
        </div>
        <div class="col s6">
            <p><b>Pan OR Tan Number :</b> {{ $user->pan_or_tan_num }}</p>
        </div>
        <div class="col s6">
            <p><b>Kyc Documents :</b></p>
            <a href="{{ asset('aadharcard/'.$user->aadhar_front) }}" target="_blank"><img src="{{ asset('aadharcard/'.$user->aadhar_front) }}" width="100" height="100" alt=""></a>
        </div>
        <div class="col s6">
            <p><b>Other Documents</b></p>
            <a href="{{ asset('aadharcard/'.$user->aadhar_back) }}" target="_blank"><img src="{{ asset('aadharcard/'.$user->aadhar_back) }}" width="100" height="100" alt=""></a>
        </div>
    </div>
</div>