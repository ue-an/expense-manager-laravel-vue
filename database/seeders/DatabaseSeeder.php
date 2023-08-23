<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $admin = Role::create(['name' => 'administrator']);
        // Permission::create(['name' => 'create_user'])->assignRole($admin);
        // Permission::create(['name' => 'update_user'])->assignRole($admin);
        // Permission::create(['name' => 'delete_user'])->assignRole($admin);
        
        // Permission::create(['name' => 'create_category'])->assignRole($admin);
        // Permission::create(['name' => 'update_category'])->assignRole($admin);
        // Permission::create(['name' => 'delete_category'])->assignRole($admin);
        
        // $user = Role::create(['name' => 'user']);
        // Permission::create(['name' => 'create_expense'])->syncRoles([$admin, $user]);
        // Permission::create(['name' => 'update_expense'])->syncRoles([$admin, $user]);
        // Permission::create(['name' => 'delete_expense'])->syncRoles([$admin, $user]);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
