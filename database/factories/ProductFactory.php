<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    protected $model = Product::class;
    public function definition(): array
    {
        return [
            'product_code'  => fake()->unique()->regexify('[A-Z0-9]{10}'),
            'user_id'       => fake()->randomElement([2, 4]),
            'slug'          => fake()->slug(3),
            'product_name'  => fake()->unique()->name(),
            'price'         => rand(10000, 50000),
            'status'        => fake()->boolean(),
        ];
    }
}
