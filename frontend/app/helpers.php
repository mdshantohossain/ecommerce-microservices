<?php

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Wishlist;


if (!function_exists('isProductInCart')) {
    function isProductInCart(int $productId)
    {
        foreach (Cart::content() as $item) {
            if ($item->id == $productId) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('isWishlist')) {
    function isWishlist(int $productId)
    {
        return Wishlist::where('product_id', $productId)->where('user_id', auth()->id())->exists();
    }
}
