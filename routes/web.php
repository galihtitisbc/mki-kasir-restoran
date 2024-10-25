<?php

use App\Events\TestNotification;
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
Route::group(['middleware' => ['auth', 'supervisorMiddleware']], function () {
    require __DIR__ . '/web/admin-supervisor/dashboard.php';
});
Route::group(['middleware' => ['auth', 'superAdminMiddleware']], function () {
    require __DIR__ . '/web/superadmin/dashboard.php';
});
Route::get('/', function () {
    return redirect('/auth/login');
});
