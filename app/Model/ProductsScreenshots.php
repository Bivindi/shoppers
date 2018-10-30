<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductsScreenshots extends Model
{
    protected $table = 'product_screenshots';

    public function Product()
    {
        return $this->belongsTo(Products::class);
    }
}
