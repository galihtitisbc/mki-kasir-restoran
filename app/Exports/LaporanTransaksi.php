<?php

namespace App\Exports;

use App\Models\SalesHistory;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanTransaksi implements FromView
{
    public function view(): View
    {
        $data = session('pdf_data');
        // dd($data);
        return view('PDF.laporan_pdf', ['data' => $data]);
    }
}
