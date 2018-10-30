<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RechargeHistory extends Model
{
    protected $table = 'recharge_history';

    const PREPAIDRECHARGE = 'Prepaid Recharge';
    const POSTPAIDRECHARGE = 'Postpaid Recharge';
    const DATACARD = 'DataCard';
    const DTHRECHARGE = 'DTH Recharge';
    const BROADBAND = 'Broadband';
    const ELECTRICITY = 'Electricity';
    const GAS = 'Gas';
    const WATER = 'Water';
    const LANDLINE = 'LandLine';

    const SUCCESS = 'Success';
    const FAILED = 'Failure';
    const PENDING = 'Pending';
    const Aborted = 'Aborted';
    const Invalid = 'Invalid';

}
