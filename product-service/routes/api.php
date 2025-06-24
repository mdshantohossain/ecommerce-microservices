<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::resource('/categories', CategoryController::class)->except(['show', 'edit']);
Route::resource('/sub-categories', SubCategoryController::class)->except(['show', 'edit']);
Route::get('/get-sub-categories/{categoryId}', [SubCategoryController::class,  'getSubCategories']);
Route::resource('/products', ProductController::class)->except(['show', 'edit']);
