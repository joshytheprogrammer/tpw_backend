<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('home')->group(function () {
  Route::get('/recommended', [ProductsController::class, 'recommended']);
});

Route::prefix('shop')->group(function () {
  Route::get('/{slug}', [ProductController::class, '']);
});