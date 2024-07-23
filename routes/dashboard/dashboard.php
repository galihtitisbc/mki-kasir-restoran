<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProductController;
use App\Models\Meja;

Route::controller(DashboardController::class)->group(function () {
    Route::get('/home/dashboard', 'index');
});
Route::controller(PegawaiController::class)->group(function () {
    Route::get('/home/pegawai', 'index');
    Route::get('/home/pegawai/tambah', 'tambahPegawai');
    Route::post('/home/pegawai/tambah', 'storePegawai');
    Route::get('/home/pegawai/edit/{user}', 'edit');
    Route::put('/home/pegawai/edit/{user}', 'update');
    Route::delete('/home/pegawai/hapus/{user}', 'hapus');
});
Route::controller(CategoryController::class)->group(function () {
    Route::get('/home/kategori', 'index');
    Route::post('/home/kategori', 'store');
    Route::put('/home/kategori/{category}', 'update');
    Route::delete('/home/kategori/{category}', 'delete');
});
Route::controller(OutletController::class)->group(function () {
    Route::get('/home/outlet', 'index');
    Route::post('/home/outlet', 'store');
    Route::put('/home/outlet/{outlet:slug}', 'update');
    Route::delete('/home/outlet/{outlet:slug}', 'destroy');
});
Route::controller(MejaController::class)->group(function () {
    Route::get('/home/meja', 'index');
    Route::post('/home/meja', 'store');
    Route::put('/home/meja/{meja:slug}', 'update');
    Route::delete('/home/meja/{meja:slug}', 'destroy');
});
Route::controller(ProductController::class)->group(function () {
    Route::get('/home/product', 'index');
    Route::post('/home/product', 'store');
    Route::put('/home/product/{product:slug}', 'update');
    Route::delete('/home/product/{product:slug}', 'destroy');
});
