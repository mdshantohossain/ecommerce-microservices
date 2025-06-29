
<!-- START HEADER -->
<header class="header_wrap">

    <div class="middle-header dark_skin">
        <div class="container">
            <div class="nav_block">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img class="logo_light" src="{{asset('/')}}website/assets/images/logo_light.png" alt="logo">
                    <img class="logo_dark" src="{{asset('/')}}website/assets/images/logo_dark.png" alt="logo">
                </a>

                <div class="product_search_form radius_input search_form_btn">
                    <form method="GET" action="{{ route('search.products') }}">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="custom_select">
                                    <select class="first_null not_chosen" name="category_id">
                                        <option value="">All Category</option>
                                        @forelse($globalCategories as  $category)
                                            <option value="{{ $category['id'] }}" {{ isset($categoryId) && $categoryId == $category['id'] ? 'selected' : '' }}>{{ $category['name'] }}</option>
                                        @empty
                                            <option value="">Doesn't have any category</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <input class="form-control" placeholder="Search Product..." id="search" name="name" type="text" />
                            <button type="submit" class="search_btn3">Search</button>
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav attr-nav align-items-center">
                    <li><a href="{{  route('user.profile')}}" class="nav-link"><i class="linearicons-user"></i></a></li>
                    <li><a href="{{ route('wishlist') }}" class="nav-link"><i class="linearicons-heart"></i><span class="wishlist_count">0</span></a></li>
                    <li class="dropdown cart_dropdown">
                        <a class="nav-link cart_trigger" href="#" data-bs-toggle="dropdown">
                            <i class="linearicons-bag2"></i>
                            <span class="cart_count">{{ count(Cart::content()) }}</span>
                            <span class="amount">
                                <span class="currency_symbol">Tk.</span>{{ Cart::subTotal() }}
                            </span>
                        </a>
                        <div class="cart_box cart_right dropdown-menu dropdown-menu-right">
                            <ul class="cart_list">
                                @forelse(Cart::content() as $cartProduct)
                                    <li>
                                    <a href="{{ route('cart.remove', $cartProduct->rowId) }}" class="item_remove"><i class="ion-close"></i></a>
                                    <a href="#"><img src="{{ $cartProduct->options->image }}" class="rounded-2" width="80" height="60" alt="{{ substr($cartProduct->name, 0, 22) }}">{{ $cartProduct->name }}</a>
                                    <span class="cart_quantity"> {{ $cartProduct->qty }} x <span class="cart_amount"> <span class="price_symbole">Tk.</span></span>{{ $cartProduct->price }}</span>
                                </li>
                                @empty
                                    <li>Cart is empty</li>
                                @endforelse
                            </ul>
                            <div class="cart_footer">
                                <p class="cart_total"><strong>Subtotal:</strong> <span class="cart_price"> <span class="price_symbole">Tk.</span></span>{{ Cart::subTotal() }}</p>
                                <p class="cart_buttons"><a href="{{ route('cart.view') }}" class="btn btn-fill-line view-cart">View Cart</a><a href="{{ route('checkout') }}" class="btn btn-fill-out checkout">Checkout</a></p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="bottom_header dark_skin main_menu_uppercase border-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-6 col-3">
                    <div class="categories_wrap">
                        <button type="button" data-bs-toggle="collapse" data-bs-target="#navCatContent" aria-expanded="false" class="categories_btn categories_menu">
                            <span>All Categories </span><i class="linearicons-menu"></i>
                        </button>
                        <div id="navCatContent" class="navbar nav collapse">
                            <ul>
                                @foreach($globalCategories as $category)
                                    <li class="dropdown dropdown-mega-menu">
                                    <a class="dropdown-item nav-link dropdown-toggler" href="{{ route('category.product', $category['slug']) }}" data-bs-toggle="dropdown">
                                        <img src="{{ $category['image'] }}" class="rounded-5" height="25" width="25" alt="">
                                        <span>{{ $category['name'] }}</span></a>
                                    <div class="dropdown-menu">
                                        <ul class="mega-menu d-lg-flex">
                                                <li class="mega-menu-col col-lg-4 col-md-4">
                                                <ul>
                                                    @foreach($category['sub_categories'] as $subCategory)
                                                    <li><a class="dropdown-item nav-link nav_item" href="{{ route('sub-category.product', $subCategory['slug']) }}">{{ $subCategory['name'] }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <div class="more_categories">More Categories</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-9">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler side_navbar_toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSidetoggle" aria-expanded="false">
                            <span class="ion-android-menu"></span>
                        </button>
                        <div class="pr_search_icon">
                            <a href="javascript:;" class="nav-link pr_search_trigger"><i class="linearicons-magnifier"></i></a>
                        </div>
                        <div class="collapse navbar-collapse mobile_side_menu" id="navbarSidetoggle">
                            <ul class="navbar-nav">
                                <li class="dropdown">
                                    <a data-bs-toggle="dropdown" class="nav-link dropdown-toggle active" href="#">Home</a>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li><a class="dropdown-item nav-link nav_item" href="index.html">Fashion 1</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="index-2.html">Fashion 2</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="index-3.html">Furniture 1</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="index-4.html">Furniture 2</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="index-5.html">Electronics 1</a></li>
                                            <li><a class="dropdown-item nav-link nav_item active" href="index-6.html">Electronics 2</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle nav-link" href="#" data-bs-toggle="dropdown">Pages</a>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li><a class="dropdown-item nav-link nav_item" href="about.html">About Us</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="contact.html">Contact Us</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="faq.html">Faq</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="404.html">404 Error Page</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="login.html">Login</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="signup.html">Register</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="term-condition.html">Terms and Conditions</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="dropdown dropdown-mega-menu">
                                    <a class="dropdown-toggle nav-link" href="#" data-bs-toggle="dropdown">Products</a>
                                    <div class="dropdown-menu">
                                        <ul class="mega-menu d-lg-flex">
                                            <li class="mega-menu-col col-lg-3">
                                                <ul>
                                                    <li class="dropdown-header">Woman's</li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-list-left-sidebar.html">Vestibulum sed</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-left-sidebar.html">Donec porttitor</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-right-sidebar.html">Donec vitae facilisis</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-list.html">Curabitur tempus</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-load-more.html">Vivamus in tortor</a></li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-3">
                                                <ul>
                                                    <li class="dropdown-header">Men's</li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-cart.html">Donec vitae ante ante</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="checkout.html">Etiam ac rutrum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="wishlist.html">Quisque condimentum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="compare.html">Curabitur laoreet</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="order-completed.html">Vivamus in tortor</a></li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-3">
                                                <ul>
                                                    <li class="dropdown-header">Kid's</li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail.html">Donec vitae facilisis</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-left-sidebar.html">Quisque condimentum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-right-sidebar.html">Etiam ac rutrum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Donec vitae ante ante</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Donec porttitor</a></li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-3">
                                                <ul>
                                                    <li class="dropdown-header">Accessories</li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail.html">Donec vitae facilisis</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-left-sidebar.html">Quisque condimentum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-right-sidebar.html">Etiam ac rutrum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Donec vitae ante ante</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Donec porttitor</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <div class="d-lg-flex menu_banners row g-3 px-3">
                                            <div class="col-lg-6">
                                                <div class="header-banner">
                                                    <div class="sale-banner">
                                                        <a class="hover_effect1" href="#">
                                                            <img src="{{asset('/')}}website/assets/images/shop_banner_img7.jpg" alt="shop_banner_img7">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="header-banner">
                                                    <div class="sale-banner">
                                                        <a class="hover_effect1" href="#">
                                                            <img src="{{asset('/')}}website/assets/images/shop_banner_img8.jpg" alt="shop_banner_img8">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle nav-link" href="#" data-bs-toggle="dropdown">Blog</a>
                                    <div class="dropdown-menu dropdown-reverse">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item menu-link dropdown-toggler" href="#">Grids</a>
                                                <div class="dropdown-menu">
                                                    <ul>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-three-columns.html">3 columns</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-four-columns.html">4 columns</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-left-sidebar.html">Left Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-right-sidebar.html">right Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-standard-left-sidebar.html">Standard Left Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-standard-right-sidebar.html">Standard right Sidebar</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="dropdown-item menu-link dropdown-toggler" href="#">Masonry</a>
                                                <div class="dropdown-menu">
                                                    <ul>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-three-columns.html">3 columns</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-four-columns.html">4 columns</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-left-sidebar.html">Left Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-right-sidebar.html">right Sidebar</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="dropdown-item menu-link dropdown-toggler" href="#">Single Post</a>
                                                <div class="dropdown-menu">
                                                    <ul>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-single.html">Default</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-single-left-sidebar.html">left sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-single-slider.html">slider post</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-single-video.html">video post</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-single-audio.html">audio post</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="dropdown-item menu-link dropdown-toggler" href="#">List</a>
                                                <div class="dropdown-menu">
                                                    <ul>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-list-left-sidebar.html">left sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-list-right-sidebar.html">right sidebar</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="dropdown dropdown-mega-menu">
                                    <a class="dropdown-toggle nav-link" href="#" data-bs-toggle="dropdown">Shop</a>
                                    <div class="dropdown-menu">
                                        <ul class="mega-menu d-lg-flex">
                                            <li class="mega-menu-col col-lg-9">
                                                <ul class="d-lg-flex">
                                                    <li class="mega-menu-col col-lg-4">
                                                        <ul>
                                                            <li class="dropdown-header">Shop Page Layout</li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-list.html">shop List view</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-list-left-sidebar.html">shop List Left Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-list-right-sidebar.html">shop List Right Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-left-sidebar.html">Left Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-right-sidebar.html">Right Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-load-more.html">Shop Load More</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-menu-col col-lg-4">
                                                        <ul>
                                                            <li class="dropdown-header">Other Pages</li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-cart.html">Cart</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="checkout.html">Checkout</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="my-account.html">My Account</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="wishlist.html">Wishlist</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="compare.html">compare</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="order-completed.html">Order Completed</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-menu-col col-lg-4">
                                                        <ul>
                                                            <li class="dropdown-header">Product Pages</li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail.html">Default</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-left-sidebar.html">Left Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-right-sidebar.html">Right Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Thumbnails Left</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-3">
                                                <div class="header_banner">
                                                    <div class="header_banner_content">
                                                        <div class="shop_banner">
                                                            <div class="banner_img overlay_bg_40">
                                                                <img src="{{asset('/')}}website/assets/images/shop_banner4.jpg" alt="shop_banner2"/>
                                                            </div>
                                                            <div class="shop_bn_content">
                                                                <h6 class="text-uppercase shop_subtitle">New Collection</h6>
                                                                <h5 class="text-uppercase shop_title">Sale 30% Off</h5>
                                                                <a href="#" class="btn btn-white rounded-0 btn-xs text-uppercase">Shop Now</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a class="nav-link nav_item" href="{{ route('contact') }}">Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="contact_phone contact_support">
                            <i class="linearicons-phone-wave"></i>
                            <span>123-456-7689</span>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END HEADER -->
