<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Middleware\SupervisorMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//auth route
Route::controller(AuthController::class)->group(function () {
    Route::get('/auth/login', 'login')->name('login');
    Route::post('/auth/login', 'loginAction');
    Route::post('/auth/logout', 'logout');
});
//dashboard
Route::group(['middleware' => ['auth', 'supervisorMiddleware']], function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/home/dashboard', 'index');
    });
    Route::controller(PegawaiController::class)->group(function () {
        Route::get('/home/pegawai', 'index');
        Route::get('/home/pegawai/tambah', 'tambahPegawai');
        Route::post('/home/pegawai/tambah', 'storePegawai');
        Route::delete('/home/pegawai/hapus/{user}', 'hapus');
    });
});

Route::get('/', function () {
    return redirect('/home/dashboard');
});
