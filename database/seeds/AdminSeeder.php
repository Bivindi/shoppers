<?php

use App\Model\Role;
use App\Model\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->first_name = 'admin';
        $user->last_name = 'admin';
        $user->username = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('password');
        $user->mobile_num = '1234567890';
        $user->slug = 'admin';
        $user->status = '1';
        $user->save();

        $role = Role::where('name', '=', 'admin')->first();
        $user->attachRole($role);
    }
}
