<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $priceInUsd = fake()->randomFloat(2, 1, 5000);

        return [
            'name' => fake()->words(3, true),
            'price_in_usd' => $priceInUsd,
            'price_in_iqd' => (int) round($priceInUsd * 1310),
            'quantity' => fake()->randomFloat(2, 1, 1000),
            'category_id' => Category::factory(),
        ];
    }
}
