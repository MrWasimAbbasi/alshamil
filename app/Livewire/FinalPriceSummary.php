<?php

namespace App\Livewire;

use App\Models\DiscountRule;
use Livewire\Component;

class FinalPriceSummary extends Component
{
    public $productPrices = [];

    protected $listeners = ['product-price-updated' => 'updatePrice'];

    public function updatePrice($productId, $price)
    {
        $this->productPrices[$productId] = $price;
    }

    public function render()
    {
        return view('livewire.final-price-summary');
    }

    public function getTotalProperty()
    {
        $subtotal = array_sum($this->productPrices);

        $finalTotal = $subtotal;

        // Check for min_total discount rule
        $minTotalRule = DiscountRule::where('type', 'total')->first();

        if (
            $minTotalRule &&
            isset($minTotalRule->condition['min_total']) &&
            $subtotal >= $minTotalRule->condition['min_total']
        ) {
            if ($minTotalRule->discount_type === 'percentage') {
                $finalTotal -= $subtotal * ($minTotalRule->amount / 100);
            } elseif ($minTotalRule->discount_type === 'fixed') {
                $finalTotal -= $minTotalRule->amount;
            }
        }

        return round(max($finalTotal, 0), 2);
    }

}
