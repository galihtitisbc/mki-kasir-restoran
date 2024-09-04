<?php

namespace Database\Factories;

use App\Models\Outlet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HistoryBayarPajak>
 */
class HistoryBayarPajakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'outlet_id'     =>  Outlet::inRandomOrder()->first()->outlet_id,
            'untuk_bulan'   =>  \Carbon\Carbon::now()->startOfMonth()->addDays(rand(1, 30))->format('F'),
            'jumlah_bayar'  =>  rand(1, 10) * 10000
        ];
    }
}
