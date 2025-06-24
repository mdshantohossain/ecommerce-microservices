<?php

namespace App\Http\Controllers;

use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubCategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.sub-category.index', [
            'subCategories' => SubCategory::all()
        ]);
    }
    public function create(): View
    {
        return view('admin.sub-category.create', [
            'categories' => Category::where('status', 1)->get()
        ]);
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:sub_categories|min:2|max:255',
        ], [
            'category_id.required' => 'The category field is required.',
        ]);
        try {
            $category = SubCategory::create($request->only('category_id', 'name', 'status'));
            if (!$category) return back()->with('error', 'Sub category not created');

            return  redirect('/sub-categories')->with('success', 'Sub category created successfully');

        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
    public function edit(SubCategory $subCategory): View
    {
        return view('admin.sub-category.edit', [
            'subCategory' => $subCategory,
            'categories' => Category::where('status', 1)->get()
        ]);
    }
    public function  update(Request $request, SubCategory $category): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:sub_categories|min:2|max:255',
        ], [
            'category_id.required' => 'The category field is required.',
        ]);

        try {
            $category->update($request->only('category_id', 'name', 'status'));
            return redirect('/sub-categories')->with('success', 'Sub category updated successfully');

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    public function destroy(SubCategory $subCategory): RedirectResponse
    {
        try {
            $subCategory->delete();

            return back()->with('success', 'Sub category deleted successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function getSubCategories(int $categoryId)
    {
        try {
            if (!$categoryId) return 'category id not found';

            $subCategories = SubCategory::where('category_id', $categoryId)
                                        ->where('status', 1)
                                        ->get();

            return response()->json($subCategories);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
