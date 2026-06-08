<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Customer Hakim Printing',
            'email' => 'customer@hakimprinting.com',
            'password' => Hash::make('Customer123!'),
            'role' => 'customer',
        ]);
    }
}
