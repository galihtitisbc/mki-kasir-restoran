<?php

namespace Database\Factories;

use App\Models\Outlet;
use App\Models\Pesanan;
use App\Models\Product;
use App\Models\SalesHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesHistory>
 */
class SalesHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SalesHistory::class;
    public function definition(): array
    {
        return [
            'product_id'   =>  Product::inRandomOrder()->first()->product_id,
            'user_id'      => fake()->randomElement([2, 4]),
            'outlet_id'     => Outlet::inRandomOrder()->first()->outlet_id,
            'pesanan_id'    => Pesanan::inRandomOrder()->first()->pesanan_id,
            'quantity'     => rand(1, 10),
            'product_price' => rand(10000, 100000),
            'total_price'  => rand(10000, 100000),
        ];
    }
}
