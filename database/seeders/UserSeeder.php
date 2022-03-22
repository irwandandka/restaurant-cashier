<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Kasir Teladan',
            'email' => 'kasir@gmail.com',
            'password' => bcrypt('kasir123'),
            'role' => 'cashier',
            'email_verified_at' => now(),
            'remember_token' => Str::random(24),
        ]);

        User::create([
            'name' => 'Owner Yang Baik',
            'email' => 'owner@gmail.com',
            'password' => bcrypt('owner123'),
            'role' => 'owner',
            'email_verified_at' => now(),
            'remember_token' => Str::random(24),
        ]);
    }
}
