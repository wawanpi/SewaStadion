<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // email admin
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'), // ganti password sesuai keinginan
                'role' => 'admin',
            ]
        );
    }
}
