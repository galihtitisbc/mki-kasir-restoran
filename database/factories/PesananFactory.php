<?php

namespace Database\Factories;

use App\Models\Meja;
use App\Models\Outlet;
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
            'outlet_id'   =>  Outlet::inRandomOrder()->first()->outlet_id,
            'status'    => 'PAID',
            'created_at'    => \Carbon\Carbon::create(null, rand(1, 12))
                ->startOfMonth()
                ->addDays(rand(1, 30))
                ->format('Y-m-d H:i:s'),
        ];
    }
}
