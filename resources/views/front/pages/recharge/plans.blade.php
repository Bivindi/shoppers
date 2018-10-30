<style>
    .no-plan {
        position: absolute;
        margin: 0 auto;
        vertical-align: middle;
        left: 50%;
        margin-top: 6%;
    }
</style>
<div class="col-sm-8 col-xs-12" id="recharge-plans">
    <div class="page-order recharge-order">

        <ul class="step">
            <li class="current-step"><a class="changesec" id="1"><span>2G Plan</span></a></li>
            <li><a class="changesec" id="2"><span>3G/4G</span></a></li>
            <li><a class="changesec" id="3"><span>Combo</span></a></li>
            <li><a class="changesec" id="4"><span>SMS</span></a></li>
            <li><a class="changesec" id="5"><span>ROAMING</span></a></li>
            <li><a class="changesec" id="6"><span>TalkTime</span></a></li>
            <li><a class="changesec" id="7"><span>STV</span></a></li>
        </ul>
        <div class="col-md-12 dataprof" style="padding: 1%;color: #908c8c;" id="sec1">
            <ul class="recharge-plans">
                @if(count($twoGPlan)>0)
                    @foreach($twoGPlan as $plan)
                        <li class="plans" price="{{ $plan[0] }}">
                            <p class="plan-price">₹{{ $plan[0] }}</p>
                            <div class="plan-details">
                                <p class="details">{{ $plan[1] }}</p>
                                <p class="validity"><span>Validity: </span><span>{{ $plan[2] }}</span></p>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="text-center no-plan">No plans</li>
                @endif
            </ul>
        </div>
        <div class="col-md-12 dataprof" style="padding: 1%;color: #908c8c;display: none;" id="sec2">
            <ul class="recharge-plans">
                @if(count($threeGFourGPlan)>0)
                    @foreach($threeGFourGPlan as $plan)
                        <li class="plans" price="{{ $plan[0] }}">
                            <p class="plan-price">₹{{ $plan[0] }}</p>
                            <div class="plan-details">
                                <p class="details">{{ $plan[1] }}</p>
                                <p class="validity"><span>Validity: </span><span>{{ $plan[2] }}</span></p>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="text-center no-plan">No plan</li>
                @endif
            </ul>
        </div>
        <div class="col-md-12 dataprof" style="padding: 1%;color: #908c8c;display: none;" id="sec3">
            <ul class="recharge-plans">
                @if(count($comboPlan)>0)
                    @foreach($comboPlan as $plan)
                        <li class="plans" price="{{ $plan[0] }}">
                            <p class="plan-price">₹{{ $plan[0] }}</p>
                            <div class="plan-details">
                                <p class="details">{{ $plan[1] }}</p>
                                <p class="validity"><span>Validity: </span><span>{{ $plan[2] }}</span></p>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="text-center no-plan">No plans</li>
                @endif
            </ul>
        </div>
        <div class="col-md-12 dataprof" style="padding: 1%;color: #908c8c;display: none;" id="sec4">
            <ul class="recharge-plans">
                @if(count($smsPlan)>0)
                    @foreach($smsPlan as $plan)
                        <li class="plans" price="{{ $plan[0] }}">
                            <p class="plan-price">₹{{ $plan[0] }}</p>
                            <div class="plan-details">
                                <p class="details">{{ $plan[1] }}</p>
                                <p class="validity"><span>Validity: </span><span>{{ $plan[2] }}</span></p>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="text-center no-plan">No plan</li>
                @endif
            </ul>
        </div>
        <div class="col-md-12 dataprof" style="padding: 1%;color: #908c8c;display: none;" id="sec5">
            <ul class="recharge-plans">
                @if(count($roamingPlan)>0)
                    @foreach($roamingPlan as $plan)
                        <li class="plans" price="{{ $plan[0] }}">
                            <p class="plan-price">₹{{ $plan[0] }}</p>
                            <div class="plan-details">
                                <p class="details">{{ $plan[1] }}</p>
                                <p class="validity"><span>Validity: </span><span>{{ $plan[2] }}</span></p>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="text-center no-plan">No plan</li>
                @endif
            </ul>
        </div>
        <div class="col-md-12 dataprof" style="padding: 1%;color: #908c8c;display: none;" id="sec6">
            <ul class="recharge-plans">
                @if(count($talktimePlan)>0)
                    @foreach($talktimePlan as $plan)
                        <li class="plans" price="{{ $plan[0] }}">
                            <p class="plan-price">₹{{ $plan[0] }}</p>
                            <div class="plan-details">
                                <p class="details">{{ $plan[1] }}</p>
                                <p class="validity"><span>Validity: </span><span>{{ $plan[2] }}</span></p>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="text-center no-plan">No plan</li>
                @endif
            </ul>
        </div>
        <div class="col-md-12 dataprof" style="padding: 1%;color: #908c8c;display: none;" id="sec7">
            <ul class="recharge-plans">
                @if(count($stvPlan)>0)
                    @foreach($stvPlan as $plan)
                        <li class="plans" price="{{ $plan[0] }}">
                            <p class="plan-price">₹{{ $plan[0] }}</p>
                            <div class="plan-details">
                                <p class="details">{{ $plan[1] }}</p>
                                <p class="validity"><span>Validity: </span><span>{{ $plan[2] }}</span></p>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="text-center no-plan">No plan</li>
                @endif
            </ul>
        </div>
    </div>
</div>

<script>
    $('.changesec').click(function () {
        var idd = $(this).attr('id');
        $('.current-step').removeClass('current-step');
        $(this).parent().addClass('current-step');
        $(".dataprof").hide();
        var data = "sec" + idd;
        $("#" + data).css('display', 'block');
    });
</script>