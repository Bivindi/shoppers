<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';

    public function getSlugForCustom($name)
    {
        $string = mb_strtolower($name, "UTF-8");
        $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", $string));
        $count = Services::where('slug', 'like', $slug . '%')->count();
        return ($count > 0) ? ($slug . '-' . $count) : $slug;
    }
}
