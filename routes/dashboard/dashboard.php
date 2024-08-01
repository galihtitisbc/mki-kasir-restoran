<?php

use App\Http\Controllers\BahanController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TaxController;

Route::prefix('dashboard')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/home', 'index');
    });
    Route::controller(PegawaiController::class)->group(function () {
        Route::get('/pegawai', 'index');
        Route::get('/pegawai/tambah', 'tambahPegawai');
        Route::post('/pegawai/tambah', 'storePegawai');
        Route::get('/pegawai/edit/{user}', 'edit');
        Route::put('/pegawai/edit/{user}', 'update');
        Route::delete('/pegawai/hapus/{user}', 'hapus');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/kategori', 'index');
        Route::post('/kategori', 'store');
        Route::put('/kategori/{category}', 'update');
        Route::delete('/kategori/{category}', 'delete');
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
        Route::delete('/produk/hapus/{product:slug}', 'destroy');
    });
    Route::resource('pajak', TaxController::class);
    Route::resource('bahan', BahanController::class);
    Route::resource('supplier', SupplierController::class);
    Route::controller(StockController::class)->group(function () {
        Route::get('/stock/sesuaikan', 'index');
    });
});
