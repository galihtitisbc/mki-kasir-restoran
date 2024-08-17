<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;

Route::get('/category/{outlet:slug}', [CategoryController::class, 'show']);
