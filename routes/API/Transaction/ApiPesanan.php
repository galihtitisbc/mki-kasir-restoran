<?php

use App\Http\Controllers\API\PesananController;

Route::post('/pesanan/', [PesananController::class, 'store']);
Route::get('/pesanans/{slug}', [PesananController::class, 'show']);
