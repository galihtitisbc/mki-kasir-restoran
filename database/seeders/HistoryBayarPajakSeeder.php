<?php

namespace Database\Seeders;

use App\Models\HistoryBayarPajak;
use App\Models\PajakyangDibayar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistoryBayarPajakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HistoryBayarPajak::factory(7)->create();
        PajakyangDibayar::factory(3)->create();
    }
}
