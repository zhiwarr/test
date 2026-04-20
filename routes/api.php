<?php

use App\Http\Controllers\Api\V1\AuthenticationController;
use App\Http\Controllers\Api\V1\Dashboard\CategoriesController;
use App\Http\Controllers\Api\V1\Dashboard\ProductsController;
use App\Http\Controllers\Api\V1\ProductsListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthenticationController::class, 'login']);
Route::get('/products', ProductsListController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('categories', CategoriesController::class);
    Route::apiResource('products', ProductsController::class)->except(['index']);
    Route::delete('/logout', [AuthenticationController::class, 'logout']);
});