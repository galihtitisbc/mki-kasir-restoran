<?php

namespace Database\Factories;

use App\Models\Tax;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tax>
 */
class TaxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Tax::class;

    public function definition(): array
    {
        return [
            'tax_name' => fake()->colorName(),
            'slug'      => fake()->slug(3),
            'tax_rate' => rand(5, 10),
            'description' => fake()->sentence(3)
        ];
    }
}
