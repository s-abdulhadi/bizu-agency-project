<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/services', [ApiController::class, 'services']);
Route::get('/portfolios', [ApiController::class, 'portfolios']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
