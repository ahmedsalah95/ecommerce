<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'iPhone 14',
                'description' => 'Latest iPhone model',
                'price' => 999.99,
                'rating' => 4.3,
                'category_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'T-shirt',
                'description' => 'Green T-shirt',
                'price' => 10.45,
                'rating' => 3.7,
                'category_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'The Theory of everything',
                'description' => 'Book by Alan turing',
                'price' => 14.00,
                'rating' => 5.00,
                'category_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];
        Product::insert($products);
    }
}
