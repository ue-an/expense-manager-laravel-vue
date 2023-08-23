<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::create(['name' => 'admin']);
        // Role::create(['name' => 'user']);
        $role_admin = Role::create(['name' => 'admin']);
        $role_standard = Role::create(['name' => 'standard']);

        $permission_read_users = Permission::create(['name' => 'read users']);
        $permission_create_users = Permission::create(['name' => 'create users']);
        $permission_update_users = Permission::create(['name' => 'update users']);
        $permission_delete_users = Permission::create(['name' => 'delete users']);

        $permission_read_categories = Permission::create(['name' => 'read categories']);
        $permission_create_categories = Permission::create(['name' => 'create categories']);
        $permission_update_categories = Permission::create(['name' => 'update categories']);
        $permission_delete_categories = Permission::create(['name' => 'delete categories']);

        $permission_read_expenses = Permission::create(['name' => 'read expenses']);
        $permission_create_expenses = Permission::create(['name' => 'create expenses']);
        $permission_update_expenses = Permission::create(['name' => 'update expenses']);
        $permission_delete_expenses = Permission::create(['name' => 'delete expenses']);

        $permissions_admin = [$permission_read_users, $permission_read_categories, $permission_read_expenses, $permission_create_users, $permission_create_categories, $permission_create_expenses, $permission_update_users, $permission_update_categories, $permission_update_expenses, $permission_delete_users, $permission_delete_categories, $permission_delete_expenses];
        $permissions_standard = [$permission_create_expenses, $permission_delete_expenses];

        $role_admin->syncPermissions($permissions_admin);
        $role_standard->syncPermissions($permissions_standard);
    }
}
