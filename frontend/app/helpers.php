<?php

use Gloudemans\Shoppingcart\Facades\Cart;

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
