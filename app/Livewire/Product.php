<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class Product extends Component
{
    public $productId;
    public $variant;

    public $rules = [
        'variant' => ['required', 'exists:App\Models\ProductVariant,id']
    ];
    public function mount()
    {

    }

    public function addToCart()
    {
        $this->validate();
    }

    #[Computed]
    public function getProduct(): \App\Models\Product
    {
        return \App\Models\Product::findOrFail($this->productId);
    }

    public function render()
    {
        return view('livewire.product');
    }
}
