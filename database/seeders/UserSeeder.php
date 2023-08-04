<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminData = [
            "name" => "admin",
            "email" => "admin@test.com",
            "is_admin" => 1,
            "password" => Hash::make("password")
        ];

        $userData= [
            [
                "name" => fake()->name(),
                "email" => "user1@test.com",
                "is_admin" => 1,
                "password" => Hash::make("password")
            ],
            [
                "name" => fake()->name(),
                "email" => "user2@test.com",
                "is_admin" => 1,
                "password" => Hash::make("password")
            ]
        ];

        $data = array_push($userData, $adminData);
        // Log::info("Database Seeder", [$data, $userData]);
        $insert = User::insert($userData);
    }
}
