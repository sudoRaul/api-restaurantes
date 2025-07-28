<?php

use App\Http\Controllers\RestauranteController;
use Illuminate\Support\Facades\Route;

Route::apiResource('restaurantes', RestauranteController::class);
