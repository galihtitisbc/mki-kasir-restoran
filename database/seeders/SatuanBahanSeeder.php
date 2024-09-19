<?php

namespace Database\Seeders;

use App\Models\SatuanBahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SatuanBahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['outlet_id' => 1, 'satuan' => 'gram'],
            ['outlet_id' => 1, 'satuan' => 'liter'],
            ['outlet_id' => 1, 'satuan' => 'butir'],
            ['outlet_id' => 1, 'satuan' => 'sendok teh'],
            ['outlet_id' => 1, 'satuan' => 'sendok makan'],
            ['outlet_id' => 1, 'satuan' => 'cangkir'],
        ];
        SatuanBahan::insert($data);
    }
}
