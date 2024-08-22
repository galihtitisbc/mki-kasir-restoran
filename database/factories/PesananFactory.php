<?php

namespace Database\Factories;

use App\Models\Meja;
use App\Models\Pesanan;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pesanan>
 */
class PesananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Pesanan::class;
    public function definition(): array
    {
        return [
            'meja_id'   =>  Meja::inRandomOrder()->first()->meja_id,
            'status'    => 'UNPAID'
        ];
    }
}
