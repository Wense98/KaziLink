<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            ['name' => 'Dar es Salaam', 'latitude' => -6.7924, 'longitude' => 39.2083],
            ['name' => 'Arusha', 'latitude' => -3.3869, 'longitude' => 36.6830],
            ['name' => 'Mwanza', 'latitude' => -2.5164, 'longitude' => 32.9175],
            ['name' => 'Dodoma', 'latitude' => -6.1630, 'longitude' => 35.7516],
            ['name' => 'Morogoro', 'latitude' => -6.8278, 'longitude' => 37.6591],
            ['name' => 'Tanga', 'latitude' => -5.0889, 'longitude' => 39.0983],
        ];

        foreach ($locations as $loc) {
            Location::create([
                'name' => $loc['name'],
                'latitude' => $loc['latitude'],
                'longitude' => $loc['longitude'],
                'type' => 'region',
            ]);
        }
    }
}
