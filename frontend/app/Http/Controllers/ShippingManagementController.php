<?php

namespace App\Http\Controllers;

use App\Models\ShippingManagement;
use Illuminate\Http\Request;

class ShippingManagementController extends Controller
{
    public function index()
    {
        return view('admin.shipping.index', [
            'shipping' => ShippingManagement::first(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
           'inside_dhaka_delivery_charge' => 'required|numeric|min:1',
           'outside_dhaka_delivery_charge' => 'required|numeric|min:1',
           'shipping_product_delivery_charge' => 'required|numeric|min:1',
        ]);

       $shipping = ShippingManagement::first();

       if (!$shipping) {
           ShippingManagement::create($request->all());

           return redirect('/dashboard')->with('success', 'Shipping created successfully');
       } else {

           $shipping->update($request->all());

           return redirect('/dashboard')->with('success', 'Shipping updated successfully');
       }
    }
}
