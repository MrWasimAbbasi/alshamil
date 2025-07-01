<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Services\PriceCalculator;

use Livewire\Attributes\Reactive;

class PriceBreakdown extends Component
{
    #[Reactive]
    public $selectedProducts;

    #[Reactive]
    public $selectedAttributes;

    #[Reactive]
    public $userType;

    public function render()
    {
        $calculator = new PriceCalculator();
        $result = $calculator->calculate(
            $this->selectedProducts ?? [],
            $this->selectedAttributes ?? [],
            $this->userType ?? 'normal'
        );

        return view('livewire.price-breakdown', ['result' => $result]);
    }
}
