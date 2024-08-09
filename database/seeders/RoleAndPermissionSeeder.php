<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        $permissions = [
            'create-space',
            'view-space',
            'update-space',
            'delete-space',
            'create-category',
            'view-category',
            'update-category',
            'delete-category',
            'view-bookings',
            'manage-bookings',
            'view-payments',
            'manage-users',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Define roles and assign existing permissions
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $adminRole = Role::create(['name' => 'admin']);

        // Assign all permissions to super-admin
        $superAdminRole->givePermissionTo(Permission::all());

    
    }
}
