<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\ShippingManagement;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    public function index()
    {
        return view('website.cart.index', [
            'deliveryCharge' => ShippingManagement::first()?->inside_dhaka_delivery_charge
        ]);
    }

    public function addCart(Request $request)
    {
        $product = (object) Http::get(env('API_GATEWAY_URL'). '/api/get-single-product/'. $request->slug)->json();

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $product->selling_price,
            'options' => [
                'image' => $product->main_image
            ]
        ]);


//        return [
//            'total' => Cart::total(),
//            'subtotal' => Cart::subtotal(),
////            'subTotal' => Cart::content()
//        ];

        return redirect('/cart')->with('success', 'Product added to cart successfully');
    }

    public function updateCartProduct(Request $request)
    {
        try {

            foreach ($request->quantities as $rowId => $quantity) {
                Cart::update($rowId, $quantity);
            }

            return back()->with('success', 'Cart updated successfully');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * remove cart product
     * @params unique rowId for each item
     */
    public function productRemove(string $rowId)
    {
        Cart::remove($rowId);

        return back()->with('success', 'Product removed from cart successfully');
    }

    public function addViaAjax(Request $request)
    {
        $product = (object) Http::get(env('API_GATEWAY_URL'). '/api/get-single-product/'. $request->slug)->json();
        if (isProductInCart($product->id)) {
            return response()->json(['warning' => 'Product already added to cart']);
        }
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $product->selling_price,
            'options' => [
                'image' => $product->main_image
            ]
        ]);

        return response()->json(['success' => 'Product added to cart successfully']);
    }
}
