<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            'admin',
            'super_admin',
            'manager',
            'cashier',
            'user',
        ];

        $roleInstances = [];
        foreach ($roles as $roleName) {
            $roleInstances[$roleName] = Role::firstOrCreate(['name' => $roleName]);
        }

        $permissionPrefixes = [
            'view',
            'view_any',
            'create',
            'update',
            'restore',
            'restore_any',
            'replicate',
            'reorder',
            'delete',
            'delete_any',
            'force_delete',
            'force_delete_any',
        ];

        $resources = [
            'users',
            'inventory',
            'products',
            'permissions',
            'roles',
            'order',
            'sales',
            'expense',
        ];

        $pages = [/* 'dashboard', etc. */];
        $widgets = [/* 'stats', 'chart', etc. */];

        foreach ($resources as $resource) {
            foreach ($permissionPrefixes as $prefix) {
                $permissionName = "{$prefix}_{$resource}";
                Permission::firstOrCreate(['name' => $permissionName]);
            }
        }

        foreach ($pages as $page) {
            foreach ($permissionPrefixes as $prefix) {
                $permissionName = "{$prefix}_{$page}";
                Permission::firstOrCreate(['name' => $permissionName]);
            }
        }

        foreach ($widgets as $widget) {
            Permission::firstOrCreate(['name' => "view_{$widget}"]);
        }

        // // Assigning all permissions (as placeholder — update as needed)
        $adminPermissions = Permission::all();

        $managerPermissions = Permission::whereIn('name', [
            'view_users',
            'view_any_users',
            'create_products',
            'update_products',
            'view_inventory',
            'create_inventory',
            'view_order',
            'view_sales',
            'create_order',
            'create_sales',
        ])->get(); // Manager has specific permissions

        $cashierPermissions = Permission::whereIn('name', [
            'view_products',
            'view_sales',
            'create_sales',
        ])->get(); // Manager has specific permissions


        $userPermissions = Permission::whereIn('name', [
            'view_products',
            'view_order',
            'create_order',
        ])->get(); // User has limited permissions


        $roleInstances['admin']->syncPermissions($adminPermissions);
        $roleInstances['super_admin']->syncPermissions($adminPermissions);

        // Empty arrays for now – add permission names as needed
        // $roleInstances['manager']->syncPermissions([]);
        $roleInstances['manager']->syncPermissions($managerPermissions);

        $roleInstances['cashier']->syncPermissions($cashierPermissions);

        $roleInstances['user']->syncPermissions($userPermissions);

        // Assigning roles to emails
        User::where('email', 'admin@gmail.com')->first()?->assignRole([
            $roleInstances['admin'],
            $roleInstances['super_admin']
        ]);

        User::where('email', 'aveva@gmail.com')->first()?->assignRole($roleInstances['super_admin']);
        User::where('email', 'user@gmail.com')->first()?->assignRole($roleInstances['user']);
    }
}

