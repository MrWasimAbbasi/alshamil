<?php

namespace App\Livewire;

use Livewire\Component;

class ProductList extends Component
{
    public $selectedProductIds = [];

    protected $listeners = ['product-selection-updated' => 'updateSelection'];

    public function updateSelection($selected)
    {
        $this->selectedProductIds = $selected;
    }

    public function render()
    {
        return view('livewire.product-list', [
            'productIds' => $this->selectedProductIds
        ]);
    }
}
