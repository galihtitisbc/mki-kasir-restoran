<?php

namespace App\Trait;

trait FormatRupiah
{

    public function rupiah($amount)
    {
        $amount = (int) $amount;
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}
