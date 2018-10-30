<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Model\Role');
    }

    public function getSlugForCustom($name)
    {
        $string = mb_strtolower($name, "UTF-8");
        $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", $string));
        $count = User::where('slug', 'like', $slug . '%')->count();
        return ($count > 0) ? ($slug . '-' . $count) : $slug;
    }

    public function wishlistedProductCount()
    {
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->get();
        return count($wishlist);
    }

    public function cartTotalPrice()
    {
        $total = DB::table('cart')
            ->join('products', 'products.id', '=', 'cart.product_id')
            ->where('cart.user_id', Auth::user()->id)
            ->sum(DB::raw('cart.price * cart.quantity'));
        if($total){
            return $total;
        }
    }

    public function number_format_short($n, $precision = 1)
    {
        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else if ($n < 900000) {
            // 0.9k-850k
            $n_format = number_format($n / 1000, $precision);
            $suffix = 'K';
        } else if ($n < 900000000) {
            // 0.9m-850m
            $n_format = number_format($n / 1000000, $precision);
            $suffix = 'M';
        } else if ($n < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($n / 1000000000, $precision);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($n / 1000000000000, $precision);
            $suffix = 'T';
        }
        // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
        // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ($precision > 0) {
            $dotzero = '.' . str_repeat('0', $precision);
            $n_format = str_replace($dotzero, '', $n_format);
        }
        return $n_format . $suffix;
    }

    public function getSellerCommission()
    {
        $flatCommission = Order::select('subcategories.*')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('subcategories.commission_type', SubCategory::FLAT)
            ->where('order.transaction_id', 'lozypay5abf7238e421e')
            ->sum('subcategories.commission');

        $percentageCommission = Order::select(DB::raw('sum(subcategories.commission * .01 * order.price) as newPrice'))
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('subcategories.commission_type', SubCategory::PERCENTAGE)
            ->where('order.transaction_id', 'lozypay5abf7238e421e')
            ->first();

        $commission = $flatCommission + $percentageCommission->newPrice;

        if (count($commission) > 0) {
            return $commission;
        } else {
            return 0;
        }
    }
}
