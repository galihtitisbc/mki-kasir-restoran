<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
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
    Route::get('/auth/login', 'login');
    Route::post('/auth/login', 'loginAction');
});
//dashboard
Route::controller(DashboardController::class)->group(function () {
    Route::get('/home/dashboard', 'index');
});
Route::get('/', function () {
    return view('welcome');
});
