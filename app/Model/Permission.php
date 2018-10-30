<?php

namespace App\Model;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{

    public function getSlugForCustom($name)
    {
        $string = mb_strtolower($name, "UTF-8");
        $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", $string));
        $count = Permission::where('slug', 'like', $slug . '%')->count();
        return ($count > 0) ? ($slug . '-' . $count) : $slug;
    }
}
