<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\ServiceCategory;
use App\Models\User;
use App\Models\WorkerProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class WorkerSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 dummy workers
        $regions = Location::where('type', 'region')->get();
        $categories = ServiceCategory::all();

        if ($regions->isEmpty() || $categories->isEmpty()) {
            return;
        }

        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'name' => "Worker {$i}",
                'email' => "worker{$i}@kazilink.com",
                'role' => 'worker',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);

            WorkerProfile::create([
                'user_id' => $user->id,
                'service_category_id' => $categories->random()->id,
                'location_id' => $regions->random()->id,
                'bio' => "Experienced professional ready to help with your needs. Specialized in quality service and timely delivery.",
                'experience_years' => rand(1, 15),
                'hourly_rate' => rand(5000, 50000),
                'is_verified' => true,
            ]);
        }
    }
}
