<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EcommerceController extends Controller
{
    public function index()
    {
        return view('website.home.index', [
            'categories' => Category::where('status', 1)->take(7)->get(),
            'products' => Product::where('status', 1)->take(10)->get(),
            'trendingProducts' => Product::where('status', 1)->latest('id')->take(10)->get(),
        ]);
    }

    public function productDetail(int $id): View
    {
        $product = Product::findOrFail($id);

        $product->total_clicked = $product->total_clicked + 1;
        $product->save();

        return  view('website.product.detail', [
            'product' => $product,
            'relatedProducts' => Product::where('category_id', $product->category_id)
                                        ->where('id', '!=', $product->id)
                                        ->where('status', 1)
                                        ->orderBy('total_clicked', 'DESC')
                                        ->take(10)
                                        ->get(),
        ]);
    }
}
