<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductsAttributes extends Model
{
    protected $table = 'product_attributes';

    public function Product()
    {
        return $this->belongsTo(Products::class);
    }

    public function getSlugForCustom($name)
    {
        $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($name)));

        $count = ProductsAttributes::where('slug', 'like', $slug . '%')->count();

        return ($count > 0) ? ($slug . '-' . $count) : $slug;
    }

    public function getAttributeName()
    {
        $size = ProductsAttributes::find($this->id);
        return $size->desc;
    }
}
