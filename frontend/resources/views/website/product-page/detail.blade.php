@extends('website.layouts.master')

@section('title', $product->name)

@section('body')
    <!-- START MAIN CONTENT -->
    <div class="main_content">

        <!-- START SECTION SHOP -->
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                        <div class="product-image">
                            <div class="product_img_box">
                                <img id="product_img" src="{{ $product->main_image }}" width="100%" height="400" data-zoom-image="{{ $product->main_image }}" alt="product_img1" />
                                <a href="#" class="product_img_zoom" title="Zoom">
                                    <span class="linearicons-zoom-in"></span>
                                </a>
                            </div>
                            <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4" data-slides-to-scroll="1" data-infinite="false">
                               @foreach($product->other_images as $otherImage)
                                    <div class="item">
                                        <a href="#" class="product_gallery_item active" data-image="{{ $otherImage['image'] }}" data-zoom-image="{{ $otherImage['image'] }}">
                                            <img src="{{ $otherImage['image'] }}" height="90" class="rounded-2" width="130" alt="product_small_img1" />
                                        </a>
                                    </div>
                               @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="pr_detail">
                            <div class="product_description">
                                <h4 class="product_title"><a href="#">{{ substr($product->name, 0, 30) }}</a></h4>

                               <div class="row">
                                   <div class="product_price">
                                       <span class="price">Tk.{{ $product->selling_price }}</span>
                                       <del>Tk.{{ $product->regular_price }}</del>
                                       @if($product->discount)
                                           <div class="on_sale">
                                               <span>{{ $product->discount }} Off</span>
                                           </div>
                                       @endif
                                   </div>
                                   <div class="rating_wrap">
                                       <div class="rating">
                                           <div class="product_rate" style="width:80%"></div>
                                       </div>
                                       <span class="rating_num">(21)</span>
                                   </div>
                               </div>

                                    <div class="pr_desc">
                                        <p>{{ $product->short_description }} </p>
                                    </div>
                                <div class="product_sort_info">
                                    <ul>
                                        <li><i class="linearicons-shield-check"></i> 1 Year AL Jazeera Brand Warranty</li>
                                        <li><i class="linearicons-sync"></i> 30 Day Return Policy</li>
                                        <li><i class="linearicons-bag-dollar"></i> Cash on Delivery available</li>
                                    </ul>
                                </div>

                            </div>
                            <hr />
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $product->slug }}" name="slug">
                                <div class="cart_extra">
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <div class="cart-product-quantity">
                                            <div class="quantity">
                                                <input type="button" value="-"  class="minus">
                                                <input type="text" name="qty" value="1" min="1" title="Qty" class="qty" size="4">
                                                <input type="button" value="+" class="plus">
                                            </div>
                                        </div>
                                        <div class="cart_btn d-flex flex-column">
                                            <button class="btn btn-fill-out btn-addtocart mb-1" @if(isProductInCart($product->id)) disabled @endif type="submit">
                                                <i class="icon-basket-loaded"></i> {{ isProductInCart($product->id) ? 'Added In Cart': ' Add to cart' }}
                                            </button>
                                            <a href="{{ route('direct.checkout', $product->slug) }}" class="btn btn-sm btn-dark ms-0">
                                                <i class="fa-regular fa-cart-shopping"></i>
                                                Order Now</a>
                                        </div>
                                        <div  class="cart_btn">
                                            <a class="add_compare" href="#"><i class="icon-shuffle"></i></a>
                                            <a class="add_wishlist" href="#"><i class="icon-heart"></i></a>
                                        </div>
                                    </form>

                                </div>
                            </form>
                            <hr />
                            <ul class="product-meta">
                                <li>SKU: <a href="#">BE45VGRT</a></li>
                                <li>Category: <a href="#">Clothing</a></li>
                                <li>Tags: <a href="#" rel="tag">Cloth</a>, <a href="#" rel="tag">printed</a> </li>
                            </ul>

                            <div class="product_share">
                                <span>Share:</span>
                                <ul class="social_icons">
                                    <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                    <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                    <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                                    <li><a href="#"><i class="ion-social-youtube-outline"></i></a></li>
                                    <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="large_divider clearfix"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="tab-style3">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="true">Description</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab">
                                <div class="tab-pane fade show active " id="Description" role="tabpanel" aria-labelledby="Description-tab">
                                    <p style="overflow-wrap: break-word;">{!! $product->long_description !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="small_divider"></div>
                        <div class="divider"></div>
                        <div class="medium_divider"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="heading_s1">
                            <h3>Related Products</h3>
                        </div>
                        <div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                            @foreach($relatedProducts as $relatedProduct)
                                <div class="item">
                                    <div class="product">
                                        <div class="">
                                            <a href="{{ route('product.detail', $relatedProduct['slug']) }}">
                                                <img src="{{ $relatedProduct['main_image'] }}" height="220" class="rounded-2" alt="product_img1">
                                            </a>
                                            <div class="mt-2">
                                                <ul class="list_none pr_action_btn">
                                                    <li class="add-to-cart">
                                                        <a
                                                            href="javascript:void(0)"
                                                            class="{{ isProductInCart($relatedProduct['id']) ? 'action-complete-style': '' }}"
                                                            onclick="event.preventDefault(); addToCart('{{ $relatedProduct['slug'] }}')"
                                                            data-slug="{{ $relatedProduct['slug'] }}"
                                                        >
                                                            <i class="icon-basket-loaded"></i>
                                                            Add To Cart
                                                        </a>
                                                    </li>
                                                    <li><a href="shop-compare.html"><i class="icon-shuffle"></i></a></li>
                                                    <li><a href="shop-quick-view.html" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                                    <li>
                                                        <a
                                                            href="javascript:void(0)"
                                                            onclick="event.preventDefault(); addToWishlist('{{ 'wishlist-'. $relatedProduct['slug'] }}')"
                                                            data-slug="wishlist-{{ $relatedProduct['slug'] }}"
                                                            class="{{ isWishlist($relatedProduct['id']) ? 'action-complete-style': '' }}"
                                                        ><i class="icon-heart"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title"><a href="{{ route('product.detail', $relatedProduct['slug']) }}">{{ $relatedProduct['name'] }}</a></h6>
                                            <div class="product_price">
                                                <span class="price">Tk.{{ $relatedProduct['selling_price'] }}</span>
                                                <del>Tk.{{ $relatedProduct['regular_price'] }}</del>
                                                @if($relatedProduct['discount'])
                                                    <div class="on_sale">
                                                        <span>{{ $relatedProduct['discount'] }} Off</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width:80%"></div>
                                                </div>
                                                <span class="rating_num">(21)</span>
                                            </div>
                                            <div class="row flex-column mt-2">
                                                <a href="{{ route('direct.checkout', $relatedProduct['slug']) }}" class=" btn btn-sm btn-dark ms-0">Order Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SECTION SHOP -->
    </div>
    <!-- END MAIN CONTENT -->

@endsection



@push('scripts')
    <script>
        function addToCart( slug ) {
            $.ajax({
                method: 'POST',
                url: '/cart-add-via-ajax',
                data: {
                    slug: slug,
                    qty: 1,
                    _token: '{{ csrf_token() }}'
                },
                success: (data) => {
                    if(data.success) {
                        const btns = document.querySelectorAll(`[data-slug="${slug}"]`);

                        btns.forEach(btn => {
                            btn.classList.add('action-complete-style');
                            btn.style.pointerEvents = 'none';
                        })

                        toastr.success(data.success)
                    }
                    if(data.warning) {
                        toastr.warning(data.warning)
                    }
                },
                error: (error) => {
                    console.error(error)
                }
            });
        }

        function addToWishlist( slug ) {
            const btns = document.querySelectorAll(`[data-slug="${slug}"]`);

            btns.forEach(btn => {
                btn.classList.add('action-complete-style');
                btn.style.pointerEvents = 'none';
            })

            // toastr.success(data.success)
            {{--$.ajax({--}}
            {{--    method: 'POST',--}}
            {{--    url: '/add-to-wishlist',--}}
            {{--    data: {--}}
            {{--        slug: slug,--}}
            {{--        user_id: {{ auth()->id() }},--}}
            {{--        _token: '{{ csrf_token() }}'--}}
            {{--    },--}}
            {{--    success: (data) => {--}}
            {{--        if(data.success) {--}}
            {{--            const btn = document.querySelector(`wishlist-#${slug}`);--}}
            {{--            btn.classList.add('action-complete-style');--}}
            {{--            btn.style.pointerEvents = 'none';--}}
            {{--            btn.setAttribute('disabled', true);--}}
            {{--            toastr.success(data.success)--}}
            {{--        }--}}
            {{--        if(data.warning) {--}}
            {{--            toastr.warning(data.warning)--}}
            {{--        }--}}
            {{--    },--}}
            {{--    error: (error) => {--}}
            {{--        console.error(error)--}}
            {{--    }--}}
            {{--});--}}
        }

    </script>
@endpush
