<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Bind {category} to use the slug field
        Route::bind('category', function (string $slug) {
            return  Category::where('slug', $slug)->firstOrFail();
        });

        // Bind {subCategory} to use the slug field=
        Route::bind('subcategory', function (string $slug) {
            return  SubCategory::where('slug', $slug)->firstOrFail();
        });

        // Bind {brand} to use the slug field
        Route::bind('brand', function (string $slug) {
            return  Brand::where('slug', $slug)->firstOrFail();
        });

        // Bind {product} to use the slug field
        Route::bind('product', function (string $slug) {
            return  Product::where('slug', $slug)->firstOrFail();
        });
    }
}
