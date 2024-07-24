<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Supplier::class;
    public function definition(): array
    {
        return [
            'user_id' => 2,
            'outlet_id' => 2,
            'supplier_name' => fake()->name('male'),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'slug'  => fake()->slug(3)
        ];
    }
}
