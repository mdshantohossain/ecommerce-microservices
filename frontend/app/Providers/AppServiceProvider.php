<?php

namespace App\Providers;

use App\Models\Admin\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        View::composer('*', function ($view) {
            $view->with([
                'globalCategories' => collect(Http::get(env('API_GATEWAY_URL'). '/api/categories')->json())->filter(function ($item) {
                    return $item['status'] == '1';
                }),
            ]);
        });
    }
}
