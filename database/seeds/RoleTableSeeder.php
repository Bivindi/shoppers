<?php

use App\Model\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            [
                'name' => 'admin',
                'display_name' => 'User Administrator',
                'description' => 'User is allowed to manage and edit other users',
            ],
            [
                'name' => 'employee',
                'display_name' => 'Project Employee',
                'description' => 'User is allowed to manage users',
            ],
            [
                'name' => 'customer',
                'display_name' => 'Project User',
                'description' => 'Simple user',
            ],
            [
                'name' => 'seller',
                'display_name' => 'Project Seller',
                'description' => 'Project seller',
            ],
        ];

        foreach ($array as $item){
            $role = new Role();
            $role->name         = $item['name'];
            $role->display_name = $item['display_name']; // optional
            $role->description  = $item['description']; // optional
            $role->save();
        }
    }
}
