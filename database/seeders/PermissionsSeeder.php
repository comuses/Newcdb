<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list attorneys']);
        Permission::create(['name' => 'view attorneys']);
        Permission::create(['name' => 'create attorneys']);
        Permission::create(['name' => 'update attorneys']);
        Permission::create(['name' => 'delete attorneys']);

        Permission::create(['name' => 'list bars']);
        Permission::create(['name' => 'view bars']);
        Permission::create(['name' => 'create bars']);
        Permission::create(['name' => 'update bars']);
        Permission::create(['name' => 'delete bars']);

        Permission::create(['name' => 'list case1s']);
        Permission::create(['name' => 'view case1s']);
        Permission::create(['name' => 'create case1s']);
        Permission::create(['name' => 'update case1s']);
        Permission::create(['name' => 'delete case1s']);

        Permission::create(['name' => 'list courts']);
        Permission::create(['name' => 'view courts']);
        Permission::create(['name' => 'create courts']);
        Permission::create(['name' => 'update courts']);
        Permission::create(['name' => 'delete courts']);

        Permission::create(['name' => 'list documents']);
        Permission::create(['name' => 'view documents']);
        Permission::create(['name' => 'create documents']);
        Permission::create(['name' => 'update documents']);
        Permission::create(['name' => 'delete documents']);

        Permission::create(['name' => 'list employees']);
        Permission::create(['name' => 'view employees']);
        Permission::create(['name' => 'create employees']);
        Permission::create(['name' => 'update employees']);
        Permission::create(['name' => 'delete employees']);

        Permission::create(['name' => 'list events']);
        Permission::create(['name' => 'view events']);
        Permission::create(['name' => 'create events']);
        Permission::create(['name' => 'update events']);
        Permission::create(['name' => 'delete events']);

        Permission::create(['name' => 'list judges']);
        Permission::create(['name' => 'view judges']);
        Permission::create(['name' => 'create judges']);
        Permission::create(['name' => 'update judges']);
        Permission::create(['name' => 'delete judges']);

        Permission::create(['name' => 'list parties']);
        Permission::create(['name' => 'view parties']);
        Permission::create(['name' => 'create parties']);
        Permission::create(['name' => 'update parties']);
        Permission::create(['name' => 'delete parties']);

        Permission::create(['name' => 'list retains']);
        Permission::create(['name' => 'view retains']);
        Permission::create(['name' => 'create retains']);
        Permission::create(['name' => 'update retains']);
        Permission::create(['name' => 'delete retains']);

        Permission::create(['name' => 'list specialities']);
        Permission::create(['name' => 'view specialities']);
        Permission::create(['name' => 'create specialities']);
        Permission::create(['name' => 'update specialities']);
        Permission::create(['name' => 'delete specialities']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
