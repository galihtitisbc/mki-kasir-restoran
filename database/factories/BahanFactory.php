<?php

namespace Database\Factories;

use App\Models\Bahan;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bahan>
 */
class BahanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Bahan::class;
    public function definition(): array
    {
        return [
            'nama_bahan' => fake()->name(),
            'slug'  => fake()->slug(3),
            'supplier_id' => Supplier::inRandomOrder()->first()->supplier_id,
            'stock' => rand(50, 100),
            'harga_bahan_per_satuan' => rand(10000, 50000),
            'harga_bahan_keseluruhan' => rand(10000, 100000),
            'satuan_bahan' => fake()->randomElement(['Liter', 'Kg', 'gr']),
        ];
    }
}
