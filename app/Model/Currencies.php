<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Currencies extends Model
{
    protected $table = 'currencies';

    public function getSlugForCustom($name)
    {
        $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($name)));

        $count = Currencies::where('slug', 'like', $slug . '%')->count();

        return ($count > 0) ? ($slug . '-' . $count) : $slug;
    }
}
