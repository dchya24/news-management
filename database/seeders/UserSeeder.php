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
        $admin= [
            "name" => "admin",
            "email" => "admin@test.com",
            "is_admin" => 1,
            "password" => Hash::make("password")
        ];

        User::insert($admin);
    }
}
