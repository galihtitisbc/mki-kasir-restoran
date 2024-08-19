<?php

use App\Http\Controllers\API\MejaController;

Route::get('/meja/{slug}', [MejaController::class, 'show']);
Route::get('/meja/detail/pesanan/{meja}', [MejaController::class, 'detailMejaTerpesan']);
