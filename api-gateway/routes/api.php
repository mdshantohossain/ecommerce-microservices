<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use  App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/product-detail/{slug}', [ProductController::class, 'productDetail']);

// get any single product send it's slug to get those product
Route::get('/get-single-product/{slug}', [ProductController::class, 'getSingleProduct']);

// search product
Route::get('/get-search-products', [ProductController::class, 'getSearchProducts']);

Route::get('/get-category-products/{slug}', [ProductController::class, 'getCategoryProducts']);
Route::get('/get-sub-category-products/{slug}', [ProductController::class, 'getSubCategoryProducts']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/sub-categories', [SubCategoryController::class, 'index']);
Route::get('/brands', [BrandController::class, 'index']);
