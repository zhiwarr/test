<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryIds = Category::query()->pluck('id')->all();

        // If there are no categories, create some and get their IDs then seed products with those category IDs
        if (empty($categoryIds)) {
            $categoryIds = Category::factory(10)->create()->pluck('id')->all();
        }

        Product::factory(200)
            ->state(fn() => ['category_id' => fake()->randomElement($categoryIds)])
            ->create();
    }
}
