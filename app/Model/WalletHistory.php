<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WalletHistory extends Model
{
    protected $table = 'wallet_history';

    const CREDIT = 'credit';
    const DEBIT = 'debit';

    const SUCCESS = 'Success';
    const FAILED = 'Failure';
    const PENDING = 'Pending';
    const Aborted = 'Aborted';
    const Invalid = 'Invalid';
}
