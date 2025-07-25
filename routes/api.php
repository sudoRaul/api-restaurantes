<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestauranteController;

Route::apiResource('restaurantes', RestauranteController::class);
