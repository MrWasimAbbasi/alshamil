<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ProductSelector extends Component
{
    public $selected = [];

    public function updatedSelected()
    {
        $this->dispatch('productUpdated', $this->selected);
    }

    public function render()
    {
        return view('livewire.product-selector', [
            'products' => Product::all()
        ]);
    }
}
