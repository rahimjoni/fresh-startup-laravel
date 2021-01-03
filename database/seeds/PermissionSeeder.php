<?php

use App\Module;
use App\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleAppDashboard = Module::updateOrCreate([
           'name'=>'Admin Dashboard'
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppDashboard->id,
            'name'=>'Access Dashboard',
            'slug'=>'app.dashboard',
        ]);

        $moduleAppRole = Module::updateOrCreate([
            'name'=>'Role Management'
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppRole->id,
            'name'=>'Access Role',
            'slug'=>'app.roles.index',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppRole->id,
            'name'=>'Access Create',
            'slug'=>'app.roles.create',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppRole->id,
            'name'=>'Access Edit',
            'slug'=>'app.roles.edit',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppRole->id,
            'name'=>'Access Delete',
            'slug'=>'app.roles.destroy',
        ]);

        $moduleAppUser = Module::updateOrCreate([
            'name'=>'User Management'
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppUser->id,
            'name'=>'Access User',
            'slug'=>'app.user.index',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppUser->id,
            'name'=>'Access Create',
            'slug'=>'app.user.create',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppUser->id,
            'name'=>'Access Edit',
            'slug'=>'app.user.edit',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppUser->id,
            'name'=>'Access Delete',
            'slug'=>'app.user.destroy',
        ]);
    }
}
