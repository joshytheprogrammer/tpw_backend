<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ConfigController;

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
  Route::get('/categories', [CategoriesController::class, 'popular']);
});

Route::prefix('shop')->group(function () {
  Route::get('/{slug}', [ProductsController::class, 'show']);
});

Route::prefix('config')->group(function () {
  Route::get('/getFormat/{id}', [ConfigController::class, 'getFormat']); // Get the default original size in inches and type of the product.
});