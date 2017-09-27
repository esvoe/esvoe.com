<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Create admin role
        $role = Role::firstOrNew(['name' => 'admin']);
        $role->display_name = 'Admin';
        $role->description = 'Access to everything';
        $role->save();

        //Create user role
        $role = Role::firstOrNew(['name' => 'user']);
        $role->display_name = 'User';
        $role->description = 'Access limited to user';
        $role->save();

        //Create moderator role
        $role = Role::firstOrNew(['name' => 'moderator']);
        $role->display_name = 'Moderator';
        $role->description = 'Access limited to moderator';
        $role->save();

        //Create editor role
        $role = Role::firstOrNew(['name' => 'editor']);
        $role->display_name = 'Editor';
        $role->description = 'Access limited to editor';
        $role->save();
    }
}
