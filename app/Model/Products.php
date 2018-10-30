<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Model\ProductsAttributes;

class Products extends Model
{
    protected $table = 'products';

    public function getColorsImages($id)
    {
        $images = DB::table('colors_images')            
            ->where('attribute_id', $id)->first();
        if ($images) {
            return $images;
        }
    }

    public function productScreenshots()
    {
        return $this->hasMany(ProductsScreenshots::class, 'product_id');
    }

    public function isProductColorImage($imageId)
    {
        $checkId = ProductsAttributes::select('image_id')->where('image_id',$imageId)->get();

        if(count($checkId) > 0){
            return false;
        }else
        {
            return true;
        }
    }

    public function ProductAttributes()
    {
        return $this->hasMany(ProductsAttributes::class, 'product_id');
    }

    public function ProductDiscount()
    {
        return $this->hasMany(ProductsDiscount::class, 'product_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function getSlugForCustom($name)
    {
        $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($name)));

        $count = Products::where('slug', 'like', $slug . '%')->count();

        return ($count > 0) ? ($slug . '-' . $count) : $slug;
    }

    public static function checkCompareProducts()
    {
        if (Auth::check()) {
            $compare = Compare::where('user_id', Auth::user()->id)->get();
            return count($compare);
        } elseif (Session::has('compare_temp_id')) {
            $compare = Compare::where('compare_temp_id', Session::get('compare_temp_id'))->get();
            return count($compare);
        }
    }

    public function CompareProducts()
    {
        if (Auth::check()) {
            $compare = Compare::where('user_id', Auth::user()->id)->get();
            return count($compare);
        } else {
            $compare = Compare::where('compare_temp_id', Session::get('compare_temp_id'))->get();
            return count($compare);
        }
    }

    public function iscompareProducts()
    {
        if (Auth::check()) {
            $compare = Compare::where('product_id', $this->id)->where('user_id', Auth::user()->id)->first();
            if ($compare) {
                return true;
            }
        } elseif (Session::has('compare_temp_id')) {
            $compare = Compare::where('product_id', $this->id)->where('compare_temp_id', Session::get('compare_temp_id'))->first();
            if ($compare) {
                return true;
            }
        }
    }

    public function isWishListProducts()
    {
        if (Auth::check()) {
            $wishlist = Wishlist::where('product_id', $this->id)->where('user_id', Auth::user()->id)->first();
            if ($wishlist) {
                return true;
            }
        }
    }

    public function getProductSize()
    {
        $productSizes = ProductsAttributes::select('id', 'desc')
            ->where('product_id', $this->id)
            ->where('name', 'size')->get();
        return $productSizes;
    }

    public function getProductSizeColor()
    {
        $productSizes = ProductsAttributes::select('*')
            ->where('product_id', $this->id)
            ->where('name', 'size-color')->get();
        return $productSizes;
    }

    public function getProductScent()
    {
        $product = ProductsAttributes::select('*')
            ->where('product_id', $this->id)
            ->where('name', 'scent')->get();
        return $product;
    }

    public function getProductSizeScent()
    {
        $product = ProductsAttributes::select('*')
            ->where('product_id', $this->id)
            ->where('name', 'size_scent')->get();
        return $product;
    }

    

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

    public function getDiscountPercentage()
    {
        $productDiscount = ProductsDiscount::select('price')
            ->whereRaw('(now() between start_date and end_date)')
            ->where('product_id', $this->id)
            ->first();
        if ($productDiscount) {
            $discount = $productDiscount->price;
            $price = $this->price;
            $percentChange = '- ' . round((($price - $discount) / $price) * 100);
            return $percentChange;
        }
    }

    public function isUserBuyProduct()
    {
        $order = Order::where('user_id', Auth::user()->id)->where('product_id', $this->id)->first();
        if (!$order) {
            return false;
        }
        return true;
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

    public function getBrandName()
    {
        $brand = Brands::find($this->brand_id);
        if ($brand) {
            return $brand->name;
        }
    }

    public function getVideoId()
    {
        $video_id = explode("?v=", $this->url); // For videos like http://www.youtube.com/watch?v=...
        if (empty($video_id[1])){
            $video_id = explode("/v/", $this->url); // For videos like http://www.youtube.com/watch/v/..
        }else{
            $video_id = explode("&", $video_id[1]); // Deleting any other params
        }
        if($video_id[0]){
            return $video_id[0];
        }
    }
}
