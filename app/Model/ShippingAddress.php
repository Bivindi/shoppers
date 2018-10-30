<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    const FREE = 'free';
    const STANDARD = 'standard';
    protected $table = 'shipping_information';
}
