<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index(Request $request)
    {
//        Http::withHeaders([
//            'Accept' => 'application/json',//            'Authorization' => $request->header('Authorization'),
//        ])->get(env('PRODUCT_SERVICE_URL') . '/api/products');

        return  Http::get(env('PRODUCT_SERVICE_URL') . '/api/products');
    }
    public function productDetail(string $slug)
    {
        try {
            if(!$slug) return  response()->json('Product not found', 404);
            return HTTP::get(env('PRODUCT_SERVICE_URL') . '/api/product-detail/' . $slug);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function getSingleProduct(string $slug)
    {
        try {
            if (!$slug) return  response()->json('Sub category not found', 404);

            return Http::get(env('PRODUCT_SERVICE_URL') . '/api/get-single-product/' . $slug);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function getCategoryProducts(string $slug)
    {
        try {
            return Http::get(env('PRODUCT_SERVICE_URL') . '/api/get-category-products/'. $slug);

        } catch (\Exception  $e) {
            return response()->json($e->getMessage());
        }
    }
    public function getSubCategoryProducts(string $slug)
    {
        try {
            return Http::get(env('PRODUCT_SERVICE_URL') . '/api/get-sub-category-products/'. $slug);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function getSearchProducts(Request $request)
    {
        try {
            $response = Http::get(env('PRODUCT_SERVICE_URL') . "/api/get-search-products", $request);
            return $response;
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
