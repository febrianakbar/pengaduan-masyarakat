<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class StaffSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'email' => 'staff@example.com',
            'password' => Hash::make('12345678'), // Password aman
            'role' => 'staff',
        ]);
    }
}
