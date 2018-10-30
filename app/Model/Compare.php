<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Compare extends Model
{
    protected $table = 'compare';

    public function productAttributes()
    {
        $products = ProductsAttributes::where('product_id', $this->product_id)->where('name', '!=', 'color')->where('name', '!=', 'size')->get();

        return $products;
    }

    public function productsize()
    {
        $products = ProductsAttributes::where('product_id', $this->product_id)->where('name', '=', 'size')->get();

        return $products;
    }

    public function productColors()
    {
        $products = ProductsAttributes::where('product_id', $this->product_id)->where('name', '=', 'color')->get();

        return $products;
    }

    public function checkWishlisted()
    {
        $wishlist = Wishlist::where('product_id', $this->product_id)->first();
        if(count($wishlist)>0){
            return true;
        }else{
            return false;
        }
    }

    public function getBrandName()
    {
        $brand = Brands::find($this->brand_id);
        if($brand){
            return $brand->name;
        }
    }
}
