<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PHPUnit\Util\Json;

class CategoryController extends Controller
{
    public function index()
    {

        return  response()->json(Category::with('subCategories')->get());

//        return view('admin.category.index', [
//            'categories' => Category::all()
//        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'image' =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' =>  'nullable',
        ]);

        try {

            $inputs = $request->except('_token');

            if ($request->hasFile('image')) {
                $inputs = $this->getImageUrl($request->file('image'), 'assets/categories/images/');
            }

            $category = Category::create($inputs);
            if (!$category) return back()->with('error', 'category not created');

            return redirect('/categories')->with('success', 'Category created successfully');

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    public function  update(Request $request, Category $category): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'image' =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' =>  'nullable',
        ]);

        try {

            $inputs = $request->except('_token');

            if ($request->hasFile('image')) {
                if (file_exists($category->image)) {
                    unlink($category->image);
                }
                $inputs = $this->getImageUrl($request->file('image'), 'assets/categories/images/');
            }

            $category->update($inputs);
            return redirect('/categories')->with('success', 'Category updated successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception);
        }
    }
    public function destroy(Category $category)
    {
        try {
            if (file_exists($category->image)) {
                unlink($category->image);
            }

            $category->delete();

            return back()->with('success', 'Category deleted successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception);
        }
    }

    public function subCategoryProducts(int $id): View
    {
        return view('website.category-product.index', [
            'products' => Product::where('sub_category_id', $id)->where('status', 1)->paginate(12),
        ]);
    }

    public function categoryProducts(int $id): View
    {
        return view('website.category-product.index', [
            'products' => Product::where('category_id', $id)->where('status', 1)->paginate(12),
        ]);
    }
}
