<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        Service::create([
            'name' => 'General Service Check-up',
            'description' => 'Complete bike check-up and tuning.',
            'price' => 499.00,
            'owner_id' => 1,
        ]);

        Service::create([
            'name' => 'Oil Change',
            'description' => 'Engine oil replacement and filter check.',
            'price' => 799.00,
            'owner_id' => 1,
        ]);

        Service::create([
            'name' => 'Water Wash',
            'description' => 'Full body water wash for your bike.',
            'price' => 299.00,
            'owner_id' => 1,
        ]);
    }
}
