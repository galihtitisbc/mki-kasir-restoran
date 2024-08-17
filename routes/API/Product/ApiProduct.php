<?php

use App\Http\Controllers\API\ProductController;

Route::get('/product/{slug}', [ProductController::class, 'show']);
