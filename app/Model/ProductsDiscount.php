<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductsDiscount extends Model
{
    protected $table = 'product_discount';

    public function Product()
    {
        return $this->belongsTo(Products::class);
    }
}
