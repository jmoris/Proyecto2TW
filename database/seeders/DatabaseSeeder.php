<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = new \App\Models\User();
        $user->name = "Jesus Moris";
        $user->email = "jesusmoriis@hotmail.com";
        $user->password = bcrypt("Moris234");
        $user->dob = date('Y-m-d H:m:s');
        $user->save();

        $superadmin = Role::create(['name' => 'superadmin']);
        $admin = Role::create(['name' => 'admin']);
        $escritor = Role::create(['name' => 'escritor']);

        $vuser = Permission::create(['name' => 'view user']);
        $cuser = Permission::create(['name' => 'create user']);
        $duser = Permission::create(['name' => 'delete user']);
        $centry = Permission::create(['name' => 'create entry']);
        $ventry = Permission::create(['name' => 'view entry']);
        $dentry = Permission::create(['name' => 'delete entry']);
        $vconfig = Permission::create(['name' => 'view config']);
        $superadmin->givePermissionTo(['view user', 'create user', 'delete user', 'create entry', 'delete entry', 'view entry', 'view config']);
        $admin->givePermissionTo(['view user', 'create user', 'delete user', 'create entry', 'delete entry', 'view entry']);
        $escritor->givePermissionTo(['create entry', 'view entry', 'delete entry']);
        $user->assignRole('superadmin');
    }
}
