<?php

use App\Http\Controllers\API\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum', 'userApi'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    require __DIR__ . '/API/Category/ApiCategory.php';
    require __DIR__ . '/API/Product/ApiProduct.php';
    require __DIR__ . '/API/Transaction/ApiMeja.php';
    require __DIR__ . '/API/Transaction/ApiPesanan.php';
    require __DIR__ . '/API/Transaction/ApiTax.php';
});
require __DIR__ . '/API/Auth/ApiAuth.php';
