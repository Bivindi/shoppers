<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductReview extends Model
{
    protected $table = 'product_review';

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
}
