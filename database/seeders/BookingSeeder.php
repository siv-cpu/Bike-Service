<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Service;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        $service = Service::first();

        if ($user && $service) {
            Booking::create([
                'user_id' => $user->id,
                'service_id' => $service->id,
                'date' => now()->format('Y-m-d'),
                'status' => '',
            ]);
        }
    }
}
