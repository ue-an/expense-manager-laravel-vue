<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Ian Aguinaldo',
                'email' => 'ian@test.com',
                'email_verified_at' => now(),
                // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'password' => 'password',
                'role' => 'admin',
            ],
            [
                'name' => 'Quinella',
                'email' => 'quin@pontifex.com',
                'email_verified_at' => now(),
                'password' => 'password',
                'role' => 'standard',
            ]
        ];

        foreach ($users as $user) {
            $created_user = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);
            $created_user->assignRole($user['role']);
        }
        // $user = User::create([
        //     'name' => 'DateUser',
        //     'email' => 'date@test.com',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        // ])->assignRole('standard');
        
    }
}
