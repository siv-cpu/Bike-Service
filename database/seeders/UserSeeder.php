<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create an Owner
        User::create([
            'name' => 'John Doe',
            'email' => 'owner@example.com',
            'mobile' => '142351543534',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create a Customer
        User::create([
            'name' => 'Alice Smith',
            'email' => 'customer@example.com',
            'mobile' => '9876501234',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);
    }
}
