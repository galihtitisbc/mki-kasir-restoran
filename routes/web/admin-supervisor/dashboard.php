<?php

use App\Http\Controllers\BahanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OpsiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanTransaksi;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SatuanBahanController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TaxController;
use Dompdf\Dompdf;

Route::prefix('dashboard')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/home', 'index');
    });
    Route::controller(PegawaiController::class)->group(function () {
        Route::get('/pegawai', 'index');
        Route::get('/pegawai/tambah', 'tambahPegawai');
        Route::post('/pegawai/tambah', 'storePegawai');
        Route::get('/pegawai/edit/{user:email}', 'edit');
        Route::put('/pegawai/edit/{user:email}', 'update');
        Route::delete('/pegawai/hapus/{user:email}', 'hapus');
        Route::patch('/pegawai/status-akun/{user:username}', 'changeStatus');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/kategori', 'index');
        Route::post('/kategori', 'store');
        Route::put('/kategori/{category:slug}', 'update');
        Route::delete('/kategori/{category:slug}', 'delete');
    });
    Route::controller(OutletController::class)->group(function () {
        Route::get('/outlet', 'index');
        Route::post('/outlet', 'store');
        Route::put('/outlet/{outlet:slug}', 'update');
        Route::delete('/outlet/{outlet:slug}', 'destroy');
    });
    Route::controller(MejaController::class)->group(function () {
        Route::get('/meja', 'index');
        Route::post('/meja', 'store');
        Route::put('/meja/{meja:slug}', 'update');
        Route::delete('/meja/{meja:slug}', 'destroy');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/produk', 'index');
        Route::get('/produk/tambah', 'tambah');
        Route::post('/produk/tambah', 'store');
        Route::get('/produk/{product:slug}', 'edit');
        Route::put('/produk/{product:slug}', 'update');
        Route::put('/produk/status/{product:slug}', 'updateStatus');
        Route::delete('/produk/hapus/{product:slug}', 'destroy');
        Route::get('/produk/{product:slug}/tambah-bahan', 'tambahBahan');
        Route::post('/produk/{product:slug}/tambah-bahan', 'storeBahanProduct');
    });
    Route::resource('pajak', TaxController::class);
    Route::get('/riwayat-bayar-pajak', [TaxController::class, 'riwayatBayarPajak']);
    Route::put('/pajak/status/{tax:slug}', [TaxController::class, 'changeStatus']);
    Route::resource('bahan', BahanController::class);
    Route::get('/satuan', [SatuanBahanController::class, 'getSatuanBahan']);
    Route::post('/store', [SatuanBahanController::class, 'storeSatuan']);
    Route::resource('supplier', SupplierController::class);
    Route::controller(StockController::class)->group(function () {
        Route::get('/stock', 'index');
        Route::get('/stock/sesuaikan', 'sesuaikan');
        Route::post('/stock/sesuaikan', 'update');
    });
    Route::controller(LaporanTransaksi::class)->group(function () {
        Route::get('/laporan/', 'index');
    });
    Route::get('/opsi', [OpsiController::class, 'getOpsi']);
    Route::get('/opsi/{opsi:slug}', [OpsiController::class, 'getDetailOpsi']);
    Route::post('/opsi', [OpsiController::class, 'store']);
    Route::get('/opsi-produk', [OpsiController::class, 'index']);
    Route::delete('/opsi/hapus/{opsi:slug}', [OpsiController::class, 'destroy']);
    Route::put('/opsi/update/{opsi:slug}', [OpsiController::class, 'update']);

    Route::get('/download-pdf', function (Request $request) {
        $data = session('pdf_data');
        // dd($data);/
        //$data['transactions']
        $html = view('PDF.laporan_pdf', compact('data'))->render();
        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->render();
        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="laporan_transaksi.pdf"');
    })->name('download-pdf');
    Route::get('/test', function () {
        $data = App\Models\SalesHistory::with('taxs')
            ->select(
                'sales_history_id',
                'created_at',
                DB::raw(
                    'SUM(total_price) AS total_penjualan'
                )
            )
            ->groupBy(DB::raw('DAY(created_at)'))
            ->get();
        // dd($data);
        return view('PDF.laporan_pdf', ['transactions' => $data, 'outlet' => 'Coral']);
    });
});
