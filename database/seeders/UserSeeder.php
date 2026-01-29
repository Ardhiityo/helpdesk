<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'password' => 11111111,
        ]);

        User::create([
            'name' => 'Arya',
            'email' => 'aryaadi229@gmail.com',
            'email_verified_at' => now(),
            'password' => 11111111,
        ]);
    }
}
