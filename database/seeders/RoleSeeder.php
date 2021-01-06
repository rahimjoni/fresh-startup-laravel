<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $adminPermissions = Permission::all();
        Role::updateOrCreate([
            'name'=>'Admin',
            'slug'=>'admin',
            'description'=>'This is the super admin',
            'deletable'=>false
        ])->permissions()->sync($adminPermissions->pluck('id'));

        Role::updateOrCreate([
            'name'=>'User',
            'slug'=>'user',
            'description'=>'This is the user',
            'deletable'=>false
        ]);
    }
}
