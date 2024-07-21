<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;

Route::group(['middleware' => ['auth', 'supervisorMiddleware']], function () {
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
});
