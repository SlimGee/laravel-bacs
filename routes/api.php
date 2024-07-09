<?php

use Illuminate\Support\Facades\Route;
use LaravelBacs\LaravelBacs\Http\Controllers\BacsController;

Route::get('/api/bacs', [BacsController::class, 'index']);
