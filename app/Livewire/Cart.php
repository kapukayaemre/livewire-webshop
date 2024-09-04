<?php

namespace App\Livewire;

use App\Factories\CartFactory;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Money\Currency;
use Money\Money;

class Cart extends Component
{
    #[Computed]
    public function cart()
    {
        return CartFactory::make()->loadMissing('items', 'items.product', 'items.variant');
    }
    #[Computed]
    public function items()
    {
        return $this->cart->items;
    }

    public function increment($itemId)
    {
        $cartItem = $this->cart->items()->find($itemId);

        if ($cartItem->quantity > 0) {
            $cartItem->increment('quantity');
        }
    }

    public function decrement($itemId)
    {
        $cartItem = $this->cart->items()->find($itemId);

        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        }
    }

    public function delete($itemId)
    {
        $this->cart->items()->where('id', $itemId)->delete();

        $this->dispatch('productRemovedFromCart');
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
