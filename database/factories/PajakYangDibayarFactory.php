<?php

namespace Database\Factories;

use App\Models\HistoryBayarPajak;
use App\Models\Outlet;
use App\Models\Tax;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PajakYangDibayar>
 */
class PajakYangDibayarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $history = HistoryBayarPajak::inRandomOrder()->first();
        $outlet = Outlet::firstWhere('outlet_id', $history->outlet_id);
        $tax = $outlet->taxs()->first()->tax_name;
        return [
            'history_bayar_pajak_id'    =>  $history->id,
            'nama_pajak'                =>  $tax,
            'total'                     =>  rand(50000, 100000)
        ];
    }
}
