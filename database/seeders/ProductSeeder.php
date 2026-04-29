<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds to populate sample data.
     */
    public function run(): void
    {
        // Create or update the 'Vegetables' category
        $veg = Category::updateOrCreate(
            ['slug' => 'vegetables'],
            ['name' => 'Vegetables']
        );

        // Add Carrot product with local image path
        Product::create([
            'category_id' => $veg->id,
            'name' => 'Fresh Carrot',
            'description' => 'High quality fresh carrots from Nuwara Eliya.',
            'price' => 250.00,
            'image' => 'images/carrot.jpg', // Path relative to the public folder
            'stock' => 100
        ]);

        // Add Cabbage product with local image path
        Product::create([
            'category_id' => $veg->id,
            'name' => 'Green Cabbage',
            'description' => 'Organic green cabbage picked from local farms.',
            'price' => 180.00,
            'image' => 'images/cabbage.jpg', // Path relative to the public folder
            'stock' => 50
        ]);
    }
}