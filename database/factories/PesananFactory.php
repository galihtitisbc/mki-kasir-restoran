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
            'product_id'    =>  Product::inRandomOrder()->first()->product_id,
            'meja_id'   =>  Meja::inRandomOrder()->first()->meja_id,
            'quantity'  =>  rand(1, 10),
            'total'     =>  rand(10000, 100000),
            'status'    => 1
        ];
    }
}
