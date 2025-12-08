<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'     => 'User Desa 1',
            'nik_id'   => 1,
            'email'    => 'user@gmail.com',
            'password' => Hash::make('user123')
        ]);

        User::create([
            'name'     => 'User Desa 2',
            'nik_id'   => 2,
            'email'    => 'testuser@email.com',
            'password' => Hash::make('user123')
        ]);
    }
}
