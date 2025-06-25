<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(): Arrayable
    {
        return Brand::all();
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:brands'
        ]);

        try {
            $category = Brand::create($request->only('name', 'status'));
            if (!$category) return back()->with('error', 'Brand not created');

            return redirect('/categories')->with('success', 'Brand created successfully');

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function  update(Request $request, Brand $brand): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:brands'
        ]);

        try {
            $brand->update($request->only('name', 'status'));
            return redirect('/categories')->with('success', 'Brand updated successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception);
        }
    }
    public function destroy(Brand $brand): RedirectResponse
    {
        try {
            $brand->delete();

            return back()->with('success', 'Brand deleted successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception);
        }
    }
}
