<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    public function index()
    {
        return Http::get(env('PRODUCT_SERVICE_URL') . '/api/categories');
    }
}
