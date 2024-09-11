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
        $tax = Tax::inRandomOrder()->first();
        return [
            'history_bayar_pajak_id'    =>  $history->id,
            'nama_pajak'                =>  $tax->tax_name,
            'total'                     =>  rand(50000, 100000)
        ];
    }
}
