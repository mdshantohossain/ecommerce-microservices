<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $origin = $request->headers->get('host');

        $response = Http::get(env('API_GATEWAY_URL') . '/api/get-search-products', $request);

        if ($response->failed()) {
            abort(404, 'Search products not found');
        }

//        if ($origin === env('APP_URL')) {
            return view('website.product-page.index', [
                'products' => $response->json()['products'],
                'categories' => $response->json()['categories'],
                'query' =>  $request->name,
                'categoryId' => $categoryId ?? ''
            ]);
//        } else {
//            abort(403);
//        }
    }
}
