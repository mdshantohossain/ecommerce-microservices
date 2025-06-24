@extends('admin.layouts.master')

@section('title', 'Shipping management')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="h2">Set Shipping Price</span>
                </div>
               <div class="card-body">
                   <form method="POST" action="{{ route('shipping.store') }}">
                       @csrf
                       <div class="mb-3">
                           <label class="form-label">Inside Dhaka <sub>(delivery charge)</sub> <span class="text-danger">*</span></label>
                           <input type="text" class="form-control" min="1" value="{{ $shipping->inside_dhaka_delivery_charge ?? old('inside_dhaka_delivery_charge') }}" name="inside_dhaka_delivery_charge" placeholder="inside of dhaka delivery charge" />
                           @error('inside_dhaka_delivery_charge')
                           <div class="text-danger">{{ $message }}</div>
                           @enderror
                       </div>
                       <div class="mb-3">
                           <label class="form-label">Outside Dhaka <sub>(delivery charge)</sub> <span class="text-danger">*</span></label>
                           <input type="text" class="form-control" min="1" value="{{ $shipping->outside_dhaka_delivery_charge ?? old('outside_dhaka_delivery_charge') }}" name="outside_dhaka_delivery_charge" placeholder="out of dhaka delivery charge"  />
                           @error('outside_dhaka_delivery_charge')
                           <div class="text-danger">{{ $message }}</div>
                           @enderror
                       </div>

                       <div class="mb-3">
                           <label class="form-label">Shipping <sub>(delivery charge)</sub> <span class="text-danger">*</span></label>
                           <input type="text" class="form-control" min="1" value="{{ $shipping->shipping_product_delivery_charge ?? old('shipping_product_delivery_charge') }}" name="shipping_product_delivery_charge" placeholder="shipping product delivery charge" />
                           @error('shipping_product_delivery_charge')
                           <div class="text-danger">{{ $message }}</div>
                           @enderror
                       </div>

                       <div>
                           <button type="submit" class="btn btn-primary w-md">{{ $shipping ? 'Update' : 'Save' }}</button>
                       </div>
                   </form>
               </div>
            </div>
        </div>
    </div>
@endsection
