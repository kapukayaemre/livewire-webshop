<?php

namespace App\Actions\Webshop;

use App\Factories\CartFactory;
use App\Models\Cart;

class MigrateSessionCart
{
    public function migrate(Cart $sessionCart, Cart $userCart)
    {
        $sessionCart->items->each(fn ($item) => $this->add(
            $item->product_variation_id,
            $item->quantity,
            $userCart
        ));

        // After migration i.e. merging carts
        // Delete all the session cart items and the cart itself
        $sessionCart->items()->delete();
        $sessionCart->delete();
    }

    public function add($variantId, $quantity = 1, $cart = null)
    {
        // If cart is defined we use it or fallback to use the factory.
        ($cart ?: CartFactory::make())->items()->firstOrCreate(
            ["product_variation_id" => $variantId],
            ["quantity" => 0]
        )->increment('quantity', $quantity);
    }
}
