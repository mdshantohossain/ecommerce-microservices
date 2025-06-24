@extends('website.layouts.master')

@section('title', 'Checkout')

@section('body')
    <!-- START MAIN CONTENT -->
    <div class="main_content">

        <!-- START SECTION SHOP -->
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="heading_s1">
                            <h4>Billing Details</h4>
                        </div>
                        <form method="POST" action="{{ route('order.store') }}">
                            @csrf

                            @if(!auth()->check())
                            <div class="form-group mb-3">
                                <input type="text"  class="form-control" name="name" placeholder="Full name *">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control" type="text" name="email" placeholder="Email address *">
                                 @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control"  type="text" name="phone" placeholder="Phone *">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @endif



                            <div class="form-group mb-3">
                                <textarea name="delivery_address" rows="5" class="form-control" placeholder="Delivery Address *">{{ old('delivery_address') }}</textarea>
                                 @error('delivery_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="payment_method">
                                        <div class="heading_s1">
                                            <h4>Payment Method</h4>
                                        </div>
                                        <div class="payment_option">
                                            <div class="custome-radio">
                                                <input class="form-check-input" type="radio" checked  name="payment_method" id="exampleRadios4" value="0">
                                                <label class="form-check-label" for="exampleRadios4">Cash On Delivery</label><br>
                                            </div>
                                            <div class="custome-radio">
                                                <input class="form-check-input" type="radio" name="payment_method" id="exampleRadios5" value="1">
                                                <label class="form-check-label" for="exampleRadios5">Online Payment</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="payment_method">
                                        <div class="heading_s1">
                                            <h4>Delivery Method</h4>
                                        </div>
                                        <div class="d-flex flex-row mb-3">
                                            <div class="custome-radio me-5">
                                                <input class="form-check-input" type="radio" checked data-bs-toggle="collapse" data-bs-target="#collapseDhaka"  name="delivery_method" id="exampleRadios7" value="1">
                                                <label class="form-check-label" for="exampleRadios7">Dhaka</label>
                                            </div>

                                            <div class="custome-radio">
                                                <input class="form-check-input" type="radio" data-bs-toggle="collapse" data-bs-target="#collapseOutDhaka" name="delivery_method" id="exampleRadios8" value="0">
                                                <label class="form-check-label" for="exampleRadios8">Out Of Dhaka</label>
                                            </div>
                                        </div>
                                        <!-- Collapsible Content -->
                                        <div class="mt-3">
                                            <!-- Dhaka Content -->
                                            <div class="collapse show" id="collapseDhaka" data-bs-parent=".mt-3">
                                               <small class="text-muted">* Delivery charge Tk.{{ $deliveryCharge->inside_dhaka_delivery_charge ?? '' }} is required.</small><br>
                                               <small class="text-muted">* Dhaka delivery selected. Estimated 1–2 days.</small>
                                            </div>

                                            <!-- Out of Dhaka Content -->
                                            <div class="collapse" id="collapseOutDhaka" data-bs-parent=".mt-3">
                                                <small class="text-muted">* Delivery charge Tk.{{ $deliveryCharge->outside_dhaka_delivery_charge ?? '' }} is required.</small><br>
                                                <small class="text-muted">* Dhaka delivery selected. Estimated 3–5 days.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

{{--                            cupon section--}}
{{--                            <div class="coupon field_form input-group mb-3">--}}
{{--                                <input type="text" value="" class="form-control" placeholder="Enter Coupon Code..">--}}
{{--                                <div class="input-group-append">--}}
{{--                                    <button class="btn btn-fill-out btn-sm" type="submit">Apply Coupon</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <button type="submit" class="btn btn-fill-out btn-block">Place Order</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="order_review">
                            <div class="heading_s1">
                                <h4>Your Orders</h4>
                            </div>
                            <div class="table-responsive order_table">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @forelse(Cart::content() as $cartProduct)
                                    <tr>
                                        <td>{{ substr($cartProduct->name, 0, 22) }} <span class="product-qty">x {{ $cartProduct->qty }}</span></td>
                                        <td>Tk.{{ $cartProduct->price * $cartProduct->qty }}</td>
                                    </tr>
                                    @empty
                                       <tr>
                                           <td colspan="2" class="text-center">
                                               <span class="h5 text-center text-muted">Didn't add to cart yet.</span>
                                           </td>
                                       </tr>
                                    @endforelse

                                    </tbody>
                                    <tfoot>
                                    @php
                                        $subtotal = (float) str_replace(',', '', Cart::subTotal());
                                        $shipping_cost = 60;
                                        $total = $subtotal + $shipping_cost;
                                    @endphp
                                    @if(!Cart::content())
                                        <tr>
                                            <th>SubTotal</th>
                                            <td class="product-subtotal">Tk.{{ $subtotal }}</td>
                                        </tr>
                                        <tr>
                                            <th>Delivery charge</th>
                                            <td>Tk.{{ $shipping_cost }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td class="product-subtotal">Tk.{{ $total }}</td>
                                        </tr>
                                    @endif
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SECTION SHOP -->

    </div>
    <!-- END MAIN CONTENT -->
@endsection
