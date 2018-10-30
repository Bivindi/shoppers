<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TaxClass extends Model
{
    const PERCENTAGE = 'percentage';
    const FLAT = 'flat';
    protected $table = 'tax_class';

    public function getSlugForCustom($name)
    {
        $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($name)));

        $count = TaxClass::where('slug', 'like', $slug . '%')->count();

        return ($count > 0) ? ($slug . '-' . $count) : $slug;
    }
}
