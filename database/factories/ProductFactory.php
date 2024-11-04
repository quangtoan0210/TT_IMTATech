<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
        return [
            'category_id'=>rand(49,60),
            'name'=>fake()->text(50),
            'sku'=>strtoupper(Str::random(8)),
            'img_thumb'=>fake()->imageUrl(),
            'price_regular'=>fake()->randomFloat(2, 1000, 100000),
            'price_sale'=>fake()->randomFloat(2, 1000, 100000),
            'quantity'=>fake()->numberBetween(0,100),
            'overview'=>fake()->text(),
            'content'=>fake()->text(200)
        ];
    }
}
