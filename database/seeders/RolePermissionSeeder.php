<?php

// In database/seeders/RolePermissionSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleUser = Role::create(['name' => 'user']);

        // Create permissions
        $permission = Permission::create(['name' => 'edit events']);

        // Assign permission to role
        $roleAdmin->givePermissionTo($permission);

        // Assign role to a user, assuming you have a user with ID 1
        $user = \App\Models\User::find(1);
        if ($user) {
            $user->assignRole('admin');
        }
    }
}
