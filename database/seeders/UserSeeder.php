<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Mostafa',
            'email' => '3nkora@gmail.com',
            'phone' => '01126481155',
            'password' => Hash::make('Mostafa@123')
        ]);
    }
}
