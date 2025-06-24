<?php

namespace App\Http\Controllers;

use App\Models\Admin\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $origin = $request->headers->get('host');
        $categoryId = $request->category_id;
        $query = Product::query();

        if ($categoryId) {
            $request->validate([
                'category_id' => 'exists:categories,id'
            ]);
            $query->where('category_id', $categoryId);
        }

//        if ($origin === env('APP_URL')) {
            return view('website.search-product.index', [
                'products' => $query->where('name', 'like', "%{$request->name}%")->get(),
                'query' =>  $request->name,
                'categoryId' => $categoryId ?? ''
            ]);
//        } else {
//            abort(403);
//        }

    }
}
