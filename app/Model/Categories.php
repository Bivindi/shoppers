<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    const PERCENTAGE = 'percentage';
    const FLAT = 'flat';
    
    protected $table = 'categories';

    public function getSlugForCustom($name)
    {
        $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($name)));

        $count = Categories::where('slug', 'like', $slug . '%')->count();

        return ($count > 0) ? ($slug . '-' . $count) : $slug;
    }

    public function subCategories(){
        return $this->hasMany(SubCategory::class, 'category_id');
    }
}
