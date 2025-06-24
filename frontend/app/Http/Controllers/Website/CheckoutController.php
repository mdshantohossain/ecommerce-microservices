<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\ShippingManagement;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('website.checkout.index', [
            'deliveryCharge' => ShippingManagement::first()
        ]);
    }

    public function directCheckout(int $productId)
    {
        $product = Product::findOrFail($productId);

        if(isProductInCart($product->id)){
            return redirect('/checkout')->with(['warning' => 'Product already added to cart for order.']);
        }
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->selling_price,
            'options' => [
                'image' => $product->main_image
            ]
        ]);

        return redirect('/checkout')->with(['success' => 'Product added to cart successfully. Order now.']);
    }
}
