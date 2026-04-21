<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\WasteCategory;

class WasteCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Sisa Sayuran', 'price_per_kg' => 1000],
            ['name' => 'Sisa Buah-buahan', 'price_per_kg' => 1200],
            ['name' => 'Daun Kering', 'price_per_kg' => 500],
            ['name' => 'Campuran (Organik)', 'price_per_kg' => 800],
        ];

        foreach ($categories as $cat) {
            WasteCategory::create($cat);
        }
    }
}
