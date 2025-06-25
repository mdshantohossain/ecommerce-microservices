<?php

namespace App\Http\Controllers;

use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.category.index', [
            'categories' => Category::all()
        ]);
    }
    public function create(): View
    {
        return view('admin.category.create');
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:categories'
        ]);

        try {
            $category = Category::create($request->only('name', 'status'));
            if (!$category) return back()->with('error', 'category not created');

            return redirect('/categories')->with('success', 'Category created successfully');

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    public function edit(Category $category): View
    {
        return view('admin.category.edit', [
            'category' => $category
        ]);
    }
    public function  update(Request $request, Category $category): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:categories'
        ]);

        try {
            $category->update($request->only('name', 'status'));
            return redirect('/categories')->with('success', 'Category updated successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception);
        }
    }
    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return back()->with('success', 'Category deleted successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception);
        }
    }

    public function categoryProducts(string $categorySlug): View
    {
        $response = Http::get(env('API_GATEWAY_URL') . '/api/get-category-products/' . $categorySlug);

        if($response->failed()) {
            abort(404, 'Products not found');
        }
        return view('website.product-page.index', [
            'products' => $response->json()['products'],
            'categories' => $response->json()['categories'],
        ]);
    }
    public function subCategoryProducts(string $subCategorySlug): View
    {
        $response = Http::get(env('API_GATEWAY_URL') . '/api/get-sub-category-products/' . $subCategorySlug);

        if($response->failed()) {
            abort(404, 'Products not found');
        }
        return view('website.product-page.index', [
            'products' => $response->json()['products'],
            'categories' => $response->json()['categories'],
        ]);
    }


}
