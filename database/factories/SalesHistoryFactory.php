<?php

namespace Database\Factories;

use App\Models\Outlet;
use App\Models\Pesanan;
use App\Models\Product;
use App\Models\SalesHistory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

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
        $bulanDipilih = rand(0, 1) === 1 ? Carbon::now() : Carbon::now()->subMonth();
        $product = Product::inRandomOrder()->first();
        return [
            'product_id'   =>  Product::inRandomOrder()->first()->product_id,
            'user_id'      => fake()->randomElement([2, 4]),
            'outlet_id'     => Outlet::inRandomOrder()->first()->outlet_id,
            'pesanan_id'    => Pesanan::inRandomOrder()->first()->pesanan_id,
            'product_name'   =>  $product->product_name,
            'quantity'     => rand(1, 10),
            'product_price' => $product->price,
            'total_price'  => rand(1, 6) * $product->price,
            'created_at'    => $bulanDipilih
                ->startOfMonth()
                ->addDays(rand(0, 29))
                ->format('Y-m-d H:i:s')
        ];
    }
}
