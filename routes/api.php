<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('admin/product', [ProductController::class, 'index']);
Route::get('admin/product/edit/{id}', [ProductController::class, 'edit']);
Route::post('admin/product',[ProductController::class, 'create']);
Route::post('admin/product/update/{id}', [ProductController::class, 'update']);
Route::delete('admin/product/delete/{id}', [ProductController::class, 'delete']);

Route::get('admin/categories', [CategoryController::class, 'index']);
Route::post('admin/categories', [CategoryController::class, 'create']);
Route::get('admin/categories/edit/{id}', [CategoryController::class, 'edit']);
Route::post('admin/categories/update/{id}', [CategoryController::class, 'update']);
Route::delete('admin/categories/delete/{id}', [CategoryController::class, 'delete']);

