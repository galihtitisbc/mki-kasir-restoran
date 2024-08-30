<?php

use App\Http\Controllers\SUPERADMIN\DashboardSuperAdmin;

Route::prefix('dashboard/superadmin')->group(function () {
    Route::controller(DashboardSuperAdmin::class)->group(function () {
        Route::get('/home', 'index');
    });
});
