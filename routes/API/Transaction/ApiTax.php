<?php

use App\Http\Controllers\API\TaxController;

Route::get('/tax/{outlet:slug}', [TaxController::class, 'show']);
