<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanTransaksi extends Controller
{
    public function index()
    {
        return view('laporan.index', [
            'title' => 'Laporan Transaksi',
        ]);
    }
}
