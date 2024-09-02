<?php

namespace App\Actions\Webshop;

use App\Factories\CartFactory;
use App\Models\Cart;

class AddProductVariantToCart
{
    public function add($variantId)
    {
        CartFactory::make()->items()->firstOrCreate(
            [
                'product_variation_id' => $variantId,
            ],
            [
                'quantity' => 0
            ]
        )->increment('quantity');
    }
}
