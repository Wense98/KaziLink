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
                'name' => 'Cleaning',
                'icon' => 'sparkles',
                'description' => 'Home and office cleaning services.',
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
