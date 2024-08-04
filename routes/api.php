<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('categories',[CategoriesController::class,"index"]);
Route::get('product',[ProductController::class,"index"]);
Route::get('/products', [ProductController::class, 'indexApi']);
Route::post('/products', [ProductController::class, 'storeApi']);
Route::put('/products/{id}', [ProductController::class, 'updateApi']);
Route::delete('/products/{id}', [ProductController::class, 'destroyApi']);
Route::get('/products/detail/{id}', [ProductController::class, 'showApi'])->name('products.show');




