<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Technical;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt(123456),
            'email_verified_at' => now()
        ]);

        Technical::create([
            'name' => 'technical',
            'email' => 'technical@gmail.com',
            'password' => bcrypt(123456)
        ]);
    }
}
