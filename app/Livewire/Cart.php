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

    public function render()
    {
        return view('livewire.cart');
    }
}
