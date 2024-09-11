<?php

use App\Http\Controllers\SUPERADMIN\DaftarOutletController;
use App\Http\Controllers\SUPERADMIN\DashboardSuperAdmin;
use App\Http\Controllers\SUPERADMIN\UserController;

Route::prefix('dashboard/superadmin')->group(function () {
    Route::controller(DashboardSuperAdmin::class)->group(function () {
        Route::get('/home', 'index');
    });
    Route::controller(DaftarOutletController::class)->group(function () {
        Route::get('/pemilik-outlet', 'index');
        Route::get('/seluruh-outlet', 'semuaOutlet');
        Route::get('/pemilik-outlet/daftar-outlet/{user:email}', 'daftarOutlet');
        Route::get('/pemilik-outlet/daftar-outlet/{slug}/detail', 'detailOutlet');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/pemilik-resto', 'create');
        Route::post('/pemilik-resto', 'store');
        Route::patch('/status-akun/{user:username}', 'changeStatus');
    });
});
