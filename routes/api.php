<?php

use Illuminate\Support\Facades\Route;
use LaravelBacs\LaravelBacs\Http\Controllers\BacsController;

Route::get(config('bacs.route'), [BacsController::class, 'index'])->middleware(config('bacs.middleware'));
