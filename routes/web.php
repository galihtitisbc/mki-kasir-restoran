<?php

use App\Http\Controllers\AuthController;
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
require __DIR__ . '/auth/auth.php';
//dashboard
require __DIR__ . '/dashboard/dashboard.php';

Route::get('/', function () {
    return redirect('/home/dashboard');
});
