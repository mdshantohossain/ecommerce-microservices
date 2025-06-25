<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\OtherImage;
use App\Models\SubCategory;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): Arrayable
    {
        return Product::orderBy('id', 'DESC')->get();
//
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
                $inputs['main_image'] = $this->getImageUrl($request->file('main_image'), 'assets/images/product-images/');
            }
            $product = Product::create($inputs);

            if (!$product) return back()->with('error', 'Product not created');

            if($request->hasFile('other_images')) {
                foreach ($request->file('other_images') as $otherImage) {
                    OtherImage::create([
                        'product_id' => $product->id,
                        'image' => $this->getImageUrl($otherImage, 'assets/images/other-images/')
                    ]);
                }
            }


            return  redirect('/products')->with('success', 'Product created successfully');

        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
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
                $inputs['main_image'] = $this->getImageUrl($request->file('main_image'), 'assets/images/product-images/');
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
                        'image' => $this->getImageUrl($otherImage, 'assets/images/other-images/')
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
    public function productDetail(Product $product)
    {
        try {

            if (!$product) return response()->json('product not found');

            return response()->json([
                'product' => $product->load('otherImages'),
                'related_products' => Product::where('sub_category_id', $product->sub_category_id)->whereStatus(1)->orderBy('id', 'DESC')->get()
            ]);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }
    public function singleProduct(string $slug)
    {
        try {
            $product = Product::with('otherImages')->where('slug', $slug)->first();

            if (!$product) return response()->json('product not found');

            return response()->json($product);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    public function getCategoryProducts(Category $category)
    {
        try {
            $products = Product::where('category_id', $category->id)->get();
            return response()->json([
                'products' => $products,
                'categories' => Category::with('products')
                    ->where('status', 1)
                    ->take(5)
                    ->get()
            ]);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function getSubCategoryProducts(SubCategory $subCategory)
    {
        try {
            $products = Product::where('sub_category_id', $subCategory->id)->get();
            return response()->json([
                'products' => $products,
                'categories' => Category::with('products')
                                        ->where('status', 1)
                                        ->take(5)
                                        ->get()
            ]);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function getSearchProducts(Request $request)
    {
        try {
            $query = Product::query();

            if ($request->category_id) {
                $query->where('category_id', $request->category_id);
            }
             $products = $query->where('name', 'like', "%$request->name%")->get();

            return response()->json([
                'products' => $products,
                'categories' => Category::with('products')
                    ->where('status', 1)
                    ->take(5)
                    ->get()
            ]);

        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }
}
