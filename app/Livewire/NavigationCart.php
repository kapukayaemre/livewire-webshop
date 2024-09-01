<?php

namespace App\Livewire;

use App\Factories\CartFactory;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class NavigationCart extends Component
{
    /* livewire v2 dispatch yerine listenerlar kullanılıyordu. Yeni ürün eklendiğinde sepeti refresh ediyor.

        public $listeners = [
            'productAddedToCart' => '$refresh',
        ]

    */

    #[Computed]
    #[On('productAddedToCart')]
    public function count()
    {
        return CartFactory::make()->items()->sum('quantity');
    }

    public function render()
    {
        return view('livewire.navigation-cart');
    }
}
