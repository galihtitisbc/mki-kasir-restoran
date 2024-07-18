<?php

namespace Database\Factories;

use App\Models\Outlet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Outlet>
 */
class OutletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Outlet::class;
    public function definition(): array
    {
        return [
            'supervisor_id' => 2,
            'outlet_name' => fake()->colorName(),
            'slug' => fake()->slug(6),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber()
        ];
    }
}
