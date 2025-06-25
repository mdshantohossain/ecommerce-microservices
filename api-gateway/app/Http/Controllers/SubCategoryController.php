<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SubCategoryController extends Controller
{
    public function index()
    {
        return Http::get(env('PRODUCT_SERVICE_URL') . '/api/sub-categories');

    }
}
