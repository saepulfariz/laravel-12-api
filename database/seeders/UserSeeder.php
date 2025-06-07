<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123')
            ],
            [
                'name' => 'creator',
                'email' => 'creator@gmail.com',
                'password' => Hash::make('123')
            ],
            [
                'name' => 'editor',
                'email' => 'editor@gmail.com',
                'password' => Hash::make('123')
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
