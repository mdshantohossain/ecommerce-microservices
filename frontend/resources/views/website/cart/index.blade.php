@extends('website.layouts.master')

@section('title', 'Cart')

@section('body')
    <!-- START MAIN CONTENT -->
    <div class="main_content">

        <!-- START SECTION SHOP -->
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive shop_cart_table">
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                        <th class="product-remove">Remove</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @forelse(Cart::content() as $cartProduct)
                                        <tr>
                                            <td class="product-thumbnail"><a href="#"><img src="{{ $cartProduct->options->image }}" width="100" height="80" class="rounded-2" alt="product1"></a></td>
                                            <td class="product-name" data-title="Product"><a href="#">{{ substr($cartProduct->name, 0, 30) }}</a></td>
                                            <td class="product-price" data-title="Price">Tk.{{ $cartProduct->price }}</td>
                                            <td class="product-quantity" data-title="Quantity"><div class="quantity">
                                                    <input type="button" value="-" class="minus">
                                                    <input type="text" name="quantities[{{ $cartProduct->rowId }}]" value="{{ $cartProduct->qty }}" title="Qty" class="qty" size="4">
                                                    <input type="button" value="+" class="plus">
                                                </div></td>
                                            <td class="product-subtotal" data-title="Total">Tk.{{ $cartProduct->price * $cartProduct->qty }}</td>
                                            <td class="product-remove" data-title="Remove">
                                                <a href="{{ route('cart.remove', $cartProduct->rowId) }}"><i class="ti-close"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                       <tr>
                                           <td>
                                               <h1>Cart is empty</h1>
                                           </td>
                                       </tr>
                                    @endforelse
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="6" class="px-0">
                                            <div class="row g-0 align-items-center">
                                                <div class="col-lg-4 col-md-6 mb-3 mb-md-0">
                                                </div>
                                                <div class="col-lg-8 col-md-6 text-start  text-md-end">
                                                    <button class="btn btn-line-fill btn-sm" type="submit">Update Cart</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="medium_divider"></div>
                        <div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
                        <div class="medium_divider"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="border p-3 p-md-4">
                            <div class="heading_s1 mb-3">
                                <h6>Cart Totals</h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table">

                                    @php
                                        $subtotal = (float) str_replace(',', '', Cart::subTotal());
                                        $total = $subtotal + $deliveryCharge;
                                    @endphp
                                    <tbody>
                                    <tr>
                                        <td class="cart_total_label">Cart Subtotal</td>
                                        <td class="cart_total_amount">Tk.{{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">Delivery charge</td>
                                        <td class="cart_total_amount">Tk.{{ $deliveryCharge }}</td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">Total</td>
                                        <td class="cart_total_amount"><strong>Tk.{{ $total  }}</strong></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ route('checkout') }}" class="btn btn-fill-out">Proceed To CheckOut</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SECTION SHOP -->

    </div>
    <!-- END MAIN CONTENT -->
@endsection
