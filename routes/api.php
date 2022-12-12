<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;


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

Route::prefix('categories')->group(function () {
    Route::get('/{id}/products', [CategoriesController::class, 'getProducts']);
});

Route::prefix('config')->group(function () {
  Route::get('/getFormat/{id}', [ConfigController::class, 'getFormat']); // Get the default original size in inches and type of the product.
  Route::post('/getCost', [ConfigController::class, 'getCost']);
  Route::post('/verifyCost', [ConfigController::class, 'getCost']);
});

Route::prefix('order')->group(function () {
  Route::post('/', [OrderController::class, 'handleOrder']);
  Route::get('/{id}', [OrderController::class, 'getOrder']);
  Route::get('/getProduct/{id}', [OrderController::class, 'getProduct']);
  Route::get('/getProducts/{id}', [OrderController::class, 'getProducts']);
  Route::post('/payment/verify', [OrderController::class, 'verifyPayment']);
});

Route::prefix('auth')->group(function () {
  Route::post('/login', [AuthController::class, 'login']);
  Route::post('/register', [AuthController::class, 'register']);
  Route::post('/logout', [AuthController::class, 'logout']);
  Route::post('/refresh', [AuthController::class, 'refresh']);
});
