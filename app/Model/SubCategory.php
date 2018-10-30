<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'subcategories';

    const FLAT = 'flat';
    const PERCENTAGE = 'percentage';

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function getSlugForCustom($name)
    {
        $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($name)));

        $count = SubCategory::where('slug', 'like', $slug . '%')->count();

        return ($count > 0) ? ($slug . '-' . $count) : $slug;
    }


    public function subCategories2()
    {
        return $this->hasMany(SubCategory2::class, 'subcategory_id');
    }
}
