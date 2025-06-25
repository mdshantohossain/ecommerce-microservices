<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;

Route::resource('categories', CategoryController::class)->except(['show', 'edit']);
Route::resource('sub-categories', SubCategoryController::class)->except(['show', 'edit']);
Route::resource('brands', BrandController::class)->except(['show', 'edit']);
Route::resource('products', ProductController::class)->except(['show', 'edit']);
Route::get('/product-detail/{product}', [ProductController::class, 'productDetail']);
Route::get('/get-category-products/{category}', [ProductController::class, 'getCategoryProducts']);
Route::get('/get-sub-category-products/{subcategory}', [ProductController::class, 'getSubCategoryProducts']);
Route::get('/get-single-product/{slug}', [ProductController::class, 'singleProduct']);
Route::get('/get-search-products', [ProductController::class, 'getSearchProducts']);

Route::get('/get-sub-categories/{categoryId}', [SubCategoryController::class,  'getSubCategories']);
