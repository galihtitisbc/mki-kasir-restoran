<?php

use App\Http\Controllers\SUPERADMIN\DaftarOutletController;
use App\Http\Controllers\SUPERADMIN\DashboardSuperAdmin;

Route::prefix('dashboard/superadmin')->group(function () {
    Route::controller(DashboardSuperAdmin::class)->group(function () {
        Route::get('/home', 'index');
    });
    Route::controller(DaftarOutletController::class)->group(function () {
        Route::get('/pemilik-outlet', 'index');
        Route::get('/pemilik-outlet/daftar-outlet/{user:email}', 'daftarOutlet');
        Route::get('/pemilik-outlet/daftar-outlet/{slug}/detail', 'detailOutlet');
    });
});
