<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Plumbing',
                'icon' => 'wrench-screwdriver',
                'description' => 'Pipe repair, installation, and maintenance.',
            ],
            [
                'name' => 'Electrical',
                'icon' => 'bolt',
                'description' => 'Wiring, appliance repair, and electrical installations.',
            ],
            [
                'name' => 'Carpentry',
                'icon' => 'hammer',
                'description' => 'Furniture making, repair, and woodworks.',
            ],
            [
                'name' => 'Home Cleaning',
                'icon' => 'sparkles',
                'description' => 'Deep cleaning, laundry, and housekeeping services.',
            ],
            [
                'name' => 'Gardening',
                'icon' => 'sun',
                'description' => 'Landscaping, lawn mowing, and garden care.',
            ],
            [
                'name' => 'Painting',
                'icon' => 'paint-brush',
                'description' => 'Interior and exterior painting services.',
            ],
            [
                'name' => 'Tutoring',
                'icon' => 'academic-cap',
                'description' => 'Private home tuition for primary and secondary students.',
            ],
            [
                'name' => 'Event Planning',
                'icon' => 'musical-note',
                'description' => 'Decor, MC services, DJ, and event coordination.',
            ],
            [
                'name' => 'Catering & Cooking',
                'icon' => 'cake',
                'description' => 'Personal chefs, baking, and event catering.',
            ],
            [
                'name' => 'Child & Elderly Care',
                'icon' => 'heart',
                'description' => 'Nannies, babysitters, and elderly caregivers.',
            ],
            [
                'name' => 'Beauty & Salon',
                'icon' => 'scissors',
                'description' => 'Mobile makeup artists, hair braiding, and nails.',
            ],
            [
                'name' => 'Transport & Moving',
                'icon' => 'truck',
                'description' => 'House moving, goods delivery, and bodaboda services.',
            ],
        ];

        foreach ($categories as $cat) {
            ServiceCategory::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'icon' => $cat['icon'],
                'description' => $cat['description'],
            ]);
        }
    }
}
