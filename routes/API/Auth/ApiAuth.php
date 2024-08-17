<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthenticationController;

Route::post('/login', [AuthenticationController::class, 'login']);
Route::middleware(['auth:sanctum', 'userApi'])->group(function () {
    Route::post('/auth/logout', [AuthenticationController::class, 'logout']);
});
