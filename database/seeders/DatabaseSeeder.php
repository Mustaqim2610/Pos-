<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'aqim26101990@gmail.com',
            ],
            [
                'name' => 'Administrator',
                'password' => Hash::make('aqim'),
                'role' => 'admin',
            ]
        );
    }
}