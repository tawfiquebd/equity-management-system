<?php

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

        // Create permissions
        Permission::create(['name' => 'view clients']);
        Permission::create(['name' => 'create clients']);
        Permission::create(['name' => 'edit clients']);
        Permission::create(['name' => 'delete clients']);
        Permission::create(['name' => 'upload holdings']);
        Permission::create(['name' => 'generate reports']);
        Permission::create(['name' => 'manage users']);

        // Create roles
        $admin = Role::create(['name' => 'Admin']);
        $manager = Role::create(['name' => 'Manager']);
        $analyst = Role::create(['name' => 'Analyst']);

        // Assign permissions to roles
        $admin->givePermissionTo(Permission::all());

        $manager->givePermissionTo([
            'view clients',
            'create clients',
            'edit clients',
            'upload holdings',
            'generate reports',
        ]);

        $analyst->givePermissionTo([
            'view clients',
            'generate reports',
        ]);
    }
}
