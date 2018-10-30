<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Wishlist extends Model
{
    protected $table = 'wishlist';

    public function getDiscountPrice()
    {
        $productDiscount = ProductsDiscount::select('price')
            ->where('start_date', '<=', date('Y-m-d H:i:s'))
            ->where('end_date', '>=', date('Y-m-d H:i:s'))
            ->where('product_id', $this->id)->first();
        if ($productDiscount) {
            return $productDiscount->price;
        }
    }

    public function getAvgRating()
    {
        $rating = ProductReview::select(DB::raw('avg(product_review.rating) as avg_rating'))
            ->join('products', 'products.id', '=', 'product_review.product_id')
            ->where('products.id', $this->id)
            ->first();
        if ($rating->avg_rating == 0) {
            return 0;
        }
        return $rating->avg_rating;
    }

    public function getAvgRating1($id)
    {
        $rating1 =  DB::table('product_review')->where('product_id','=', $id)->avg('rating');

        if ($rating1 == 0) {
            return 0;
        }
        return $rating1;
    }   
}
