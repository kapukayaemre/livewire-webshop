<?php

namespace App\Livewire;

use App\Factories\CartFactory;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Cart extends Component
{
    #[Computed]
    public function items()
    {
        return CartFactory::make()->items;
    }

    public function increment($itemId)
    {
        $cartItem = CartFactory::make()->items()->find($itemId);

        if ($cartItem->quantity > 0) {
            $cartItem->increment('quantity');
        }
    }

    public function decrement($itemId)
    {
        $cartItem = CartFactory::make()->items()->find($itemId);

        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        }
    }

    public function delete($itemId)
    {
        CartFactory::make()->items()->where('id', $itemId)->delete();

        $this->dispatch('productRemovedFromCart');
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
