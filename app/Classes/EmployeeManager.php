<?php
/**
 * Created by PhpStorm.
 * User: xyz
 * Date: 2/21/2018
 * Time: 4:59 PM
 */

namespace App\Classes;


use App\Model\Role;

class EmployeeManager
{
    public function saveEmployeeDetails($user, $request)
    {
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        if (isset($user->username)) {
            if ($user->username != $request->get('username')) {
                $user->slug = $user->getSlugForCustom($request->get('username'));
            }
        } else {
            $user->slug = $user->getSlugForCustom($request->get('username'));
        }
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->mobile_num = trim($request->get('mobile_number'));
        $user->state = $request->get('state');
        $user->city = $request->get('city');
        if($request->get('status') == 'active'){
            $user->status = 1;
        }else{
            $user->status = 0;
        }
        if ($request->file('profile')) {
            $profile = time() . '.' . $request->file('profile')->getClientOriginalExtension();
            $request->file('profile')->move(public_path('/profile/'), $profile);
            $user->profile = $profile;
            if (\File::exists(public_path() . '/profile/' . $request->get('oldProfile'))) {
                \File::delete(public_path() . '/profile/' . $request->get('oldProfile'));
            }
        } else {
            $user->profile = $request->get('oldProfile');
        }
        $user->save();

        return $user;
    }

    public function savePermoission($permission, $request)
    {
        if (isset($permission->name)) {
            if ($permission->name != $request->get('name')) {
                $permission->slug = $permission->getSlugForCustom($request->get('name'));
            }
        } else {
            $permission->slug = $permission->getSlugForCustom($request->get('name'));
        }
        $permission->name = $request->get('name');
        $permission->display_name = $request->get('display_name');
        $permission->description = $request->get('description');
        $permission->save();
        return $permission;
    }
}