<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 20 categories
        Category::factory()->count(20)->create();

        // Create 60,000 products
        $chunks = 20;
        $perChunk = 3000;

        for ($i = 0; $i < $chunks; $i++) {
            Product::factory()->count($perChunk)->create();
        }
    }
}
