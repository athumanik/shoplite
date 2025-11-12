<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                "name" => "System admin",
                "username" => "admin",
                // "phone" => "+255 789 012 990",
                "email" => "admin@gmail.com",
            ],

            [
                "name" => "User",
                "username" => "user",
                // "phone" => "+255 799 010 289",
                "email" => "user@gmail.com",
            ],
            [
                "name" => "Evance Emmanuel",
                "username" => "aveva",
                // "phone" => "+255 799 010 289",
                "email" => "aveva@gmail.com",
            ],


        ];

        $data = [];
        foreach ($users as $user) {
            $data[] = [
                "name" => $user['name'],
                "username" => $user['username'],
                // 'phone' => $user['phone'],
                "email" => $user['email'],
                'email_verified_at' => now(),
                "password" => bcrypt("12345678"),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('users')->insert($data);
    }
}
