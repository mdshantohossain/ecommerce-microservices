<?php

namespace App\Http\Controllers;

use App\Events\AddProductEvent;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\SubCategory;
use App\Models\OtherImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('admin.product.index', [
            'products' => Product::orderBy('id', 'DESC')->get()
        ]);
    }
    public function create(): View
    {
        return view('admin.product.create', [
            'categories' => Category::where('status',  1)->get(),
            'subCategories' => SubCategory::where('status',  1)->get(),
            ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'name' => 'required',
            'regular_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'discount' => 'string|nullable',
            'quantity' => 'string',
            'short_description' => 'string|required',
            'long_description' => 'string|nullable',
            'main_image' => 'required|image',
            'other_images' => 'required|array',
            'other_images.*' => 'image',
            'status' => 'required'
        ], [
            'category_id.required' => 'Category is required',
            'sub_category_id.required' => 'Sub Category is required',
            'other_images.required' => 'Other image is required',
        ]);

        try {
            $inputs = $request->only([
                'category_id',
                'sub_category_id',
                'name',
                'regular_price',
                'selling_price',
                'discount',
                'quantity',
                'short_description',
                'long_description',
                'main_image',
                'status'
            ]);

            if($request->hasFile('main_image')) {
                $inputs['main_image'] = $this->getImageUrl($request->file('main_image'), 'admin/assets/images/product-images/');
            }
            $product = Product::create($inputs);

            if (!$product) return back()->with('error', 'Product not created');

            if($request->hasFile('other_images')) {
               foreach ($request->file('other_images') as $otherImage) {
                   OtherImage::create([
                      'product_id' => $product->id,
                      'image' => $this->getImageUrl($otherImage, 'admin/assets/images/other-images/')
                   ]);
               }
            }

            // event
            event(new AddProductEvent($product->load('otherImages')));

            return  redirect('/products')->with('success', 'Product created successfully');

        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
    public function show(Product $product): View
    {
        return view('admin.product.show', [
            'product' => $product
        ]);
    }
    public function edit(Product $product): View
    {
        return view('admin.product.edit', [
            'categories' => Category::where('status',  1)->get(),
            'subCategories' => SubCategory::where('status',  1)->get(),
            'product' => $product
        ]);
    }
    public function  update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'name' => 'required',
            'regular_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'discount' => 'string|nullable',
            'quantity' => 'numeric',
            'short_description' => 'string|required',
            'long_description' => 'string|nullable',
        ]);

        try {
            $inputs = $request->only([
                'category_id',
                'sub_category_id',
                'name',
                'regular_price',
                'selling_price',
                'discount',
                'quantity',
                'short_description',
                'long_description',
                'main_image',
                'status'
            ]);

            if ($request->hasFile('main_image')) {
                if(file_exists($product->main_image)) {
                    unlink($product->main_image);
                }
                $inputs['main_image'] = $this->getImageUrl($request->file('main_image'), 'admin/assets/images/product-images/');
            }

            $product->update($inputs);

            if ($request->hasFile('other_images')) {
                foreach ($product->otherImages  as $otherImage) {
                    if (file_exists($otherImage)) {
                        unlink($otherImage);
                    }
                    $otherImage->delete();
                }
                foreach ($request->file('other_images') as $otherImage) {
                    OtherImage::create([
                        'product_id' => $product->id,
                        'image' => $this->getImageUrl($otherImage, 'admin/assets/images/other-images/')
                    ]);
                }
            }

            return redirect()->route('products.index')->with('success', 'Product updated successfully');

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception);
        }
    }
    public function destroy(Product $product): RedirectResponse
    {
        try {

            $otherImages = OtherImage::where('product_id', $product->id)->get();
            foreach ($otherImages as $otherImage) {
                if (file_exists($otherImage->image))
                {
                    unlink($otherImage->image);
                }
                $otherImage->delete();
            }

            $product->delete();

            return back()->with('success', 'Product deleted successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception);
        }
    }
}
