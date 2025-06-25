<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class EcommerceController extends Controller
{
    public function index()
    {
        $products = collect(Http::get(env('API_GATEWAY_URL'). '/api/products')->json());

        return view('website.home.index', [
            'products' => $products->take(10),
            'trendingProducts' => $products->sortByDesc('id')->take(10),
        ]);
    }

    public function productDetail(string $slug)
    {
        $data = Http::get(env('API_GATEWAY_URL'). '/api/product-detail/'. $slug)->json();

        return  view('website.product-page.detail', [
            'product' => (object) $data['product'],
            'relatedProducts' => $data['related_products']
        ]);
    }
}
