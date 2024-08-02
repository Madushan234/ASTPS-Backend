<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Admin',
                'last_name' => 'user',
                'email' => 'admin@gmail.com',
                'password' => 'password',
                'roles' => 'admin',
                'email_verified_at' => now()
            ],
            [
                'first_name' => 'Agent',
                'last_name' => 'user',
                'email' => 'agent@gmail.com',
                'password' => 'password',
                'roles' => 'agent',
                'email_verified_at' => now()
            ],
            [
                'first_name' => 'Customer',
                'last_name' => 'user',
                'email' => 'customer@gmail.com',
                'password' => 'password',
                'roles' => 'customer',
                'email_verified_at' => now()
            ]
        ];

        foreach ($users as $userData) {
            if (!User::where('email', $userData['email'])->first()) {
                $user = User::create([
                    'first_name' => $userData['first_name'],
                    'last_name' => $userData['last_name'],
                    'email' => $userData['email'],
                    'email_verified_at' => $userData['email_verified_at'],
                    'telephone' => null,
                    'password' => (App::environment('production')) ? Hash::make($userData['password']) : Hash::make('password')
                ]);
                $user->addRole($userData['roles']);
            }
        }
    }
}

