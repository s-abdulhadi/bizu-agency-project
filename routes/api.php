<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public API Routes
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);

Route::get('/servicesk', [ApiController::class, 'services']);
Route::get('/portfolios', [ApiController::class, 'portfolios']);

// CRUD APIs for Checklist Compliance
Route::middleware('auth:api')->group(function () {
    Route::apiResource('products', App\Http\Controllers\Api\ProductController::class);
    Route::apiResource('services', App\Http\Controllers\Api\ServiceController::class);
    Route::apiResource('portfolio', App\Http\Controllers\Api\PortfolioController::class);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
