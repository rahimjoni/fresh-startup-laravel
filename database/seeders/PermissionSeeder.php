<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeders.
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

        //users
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

        //backups
        $moduleAppBackups = Module::updateOrCreate([
            'name'=>'Backups Management'
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppBackups->id,
            'name'=>'Access Backups',
            'slug'=>'app.backups.index',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppBackups->id,
            'name'=>'Backups Create',
            'slug'=>'app.backups.create',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppBackups->id,
            'name'=>'Download Backups',
            'slug'=>'app.backups.download',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppBackups->id,
            'name'=>'Backups Delete',
            'slug'=>'app.backups.destroy',
        ]);

        //Pages
        $moduleAppPages = Module::updateOrCreate([
            'name'=>'Pages Management'
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppPages->id,
            'name'=>'Access Pages index',
            'slug'=>'app.pages.index',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppPages->id,
            'name'=>'Pages Create',
            'slug'=>'app.pages.create',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppPages->id,
            'name'=>'Pages Edit',
            'slug'=>'app.pages.edit',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppPages->id,
            'name'=>'Pages Delete',
            'slug'=>'app.pages.destroy',
        ]);

        //Profiles
        $moduleAppProfiles = Module::updateOrCreate([
            'name'=>'Profile Management'
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppProfiles->id,
            'name'=>'Profile Update',
            'slug'=>'app.profile.update',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppProfiles->id,
            'name'=>'Change Password',
            'slug'=>'app.profile.password',
        ]);

    }
}
