<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ShippingManagement;
use App\Models\User;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $shipping = ShippingManagement::first();


        $request->validate([
           'delivery_address' => 'required',
        ], [
            'delivery_address.required' => 'Delivery address is required',
        ]);

        try {

            if(!auth()->check()) {
                $user = User::where('email', $request->email)->first(); // check if exists user

                if (!$user) {
                    $request->validate([
                        'name' => 'required',
                        'email' => 'required|email|unique:users.email',
                        'phone' => 'required',
                    ]);
                    $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                    ]);
                }
                Auth::login($user); // user log-in
            }

            // Calculate delivery charge
            $delivery_charge = $shipping && $request->delivery_method == 1
                ? $shipping?->inside_dhaka_delivery_charge
                : $shipping?->outside_dhaka_delivery_charge;

            $payment_method = $request->payment_method;
            $delivery_address = $request->delivery_address;
            $order_total = (float) str_replace(',', '', Cart::subTotal());
            $payment_method = $request->payment_method;
            $delivery_method = $request->delivery_method;

            return redirect('/example2')->with(compact(
                'delivery_charge',
                'payment_method',
                'delivery_address',
                'order_total',
                'delivery_method'
            ));

//            $order = Order::create([
//                'user_id' => $user->id,
//                'order_total' => Cart::subTotal(),
//                'order_date' => date('Y-m-d'),
//                'order_timestamp' => strtotime(date('Y-m-d H:i:s')),
//                'order_status' => 0,
//                'delivery_address' => $request->delivery_address,
//                'delivery_date' => date('Y-m-d'),
//                'delivery_timestamp' => strtotime(date('Y-m-d H:i:s')),
//                'delivery_method' => $request->delivery_method,
//                'delivery_charge' => $deliveryCharge,
//                'delivery_charge_status' => $deliveryCharge,
//                'delivery_status' => 0,
//                'payment_method' => $request->payment_method,
//            ]);

            foreach (Cart::content() as $item) {
                $product = Product::where('id', $item->id)->first();
                $product->quantity = $product->quantity - $item->qty;
                $product->save();

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'quantity' => $item->qty,
                ]);

                Cart::remove($item->rowId);
            }

            return redirect('/')->with('success', 'Order placed successfully');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
