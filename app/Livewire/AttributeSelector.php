<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use App\Models\Product;

class AttributeSelector extends Component
{
    #[Reactive]
    public $selectedProducts = [];

    #[Reactive]
    public $selectedAttributes = [];

    public function updatedSelectedAttributes(): void
    {
        $this->dispatch('attributeUpdated', $this->selectedAttributes);
    }

    public function render()
    {
        $attributes = collect();
        if (!empty($this->selectedProducts)) {
            $attributes = Product::with('attributes')
                ->whereIn('id', $this->selectedProducts)
                ->get()
                ->pluck('attributes')
                ->flatten()
                ->unique('id')
                ->groupBy('group');
        }

        return view('livewire.attribute-selector', compact('attributes'));
    }

    #[On('refresh')]
    public function refresh()
    {
        // do nothing or reload state
    }
}
