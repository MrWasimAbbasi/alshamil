<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class PriceConfigurator extends Component
{
    public $selectedProducts = [];
    public $selectedAttributes = [];
    public $userType = 'normal'; // or 'company'

    protected $listeners = [
        'productUpdated' => 'updateProducts',
        'attributeUpdated' => 'updateAttributes',
        'userTypeUpdated' => 'updateUserType',
    ];

    public function updateProducts($products)
    {
        $this->selectedProducts = $products;
    }

    public function updateAttributes($attributes)
    {
        $this->selectedAttributes = $attributes;
    }

    public function updateUserType($type)
    {
        $this->userType = $type;
    }

    public function render()
    {
        return view('livewire.price-configurator');
    }
}
