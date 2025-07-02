<?php

namespace App\Livewire;

use App\Models\DiscountRule;
use Livewire\Component;

class FinalPriceSummary extends Component
{
    public $productPrices = [];

    public $userType = 'normal';

    protected $listeners = [
        'product-price-updated' => 'updateProductPrice',
        'user-type-updated' => 'setUserType',
        'product-selection-updated' => 'syncWithSelectedProducts',
    ];

    public function setUserType($type)
    {
        $this->userType = $type;
    }

    public function updateProductPrice($productId, $price)
    {
        $this->productPrices[$productId] = $price;
    }

    public function render()
    {
        return view('livewire.final-price-summary');
    }

    public function getTotalProperty()
    {
        if (empty($this->productPrices)) {
            return 0;
        }

        $subtotal = array_sum($this->productPrices);
        $total = $subtotal;

        // 🔸 Apply total-based discount (min_total rule)
        $minTotalRule = DiscountRule::where('type', 'total')->first();

        if ($minTotalRule) {
            $condition = json_decode($minTotalRule->condition, true);

            if (isset($condition['min_total']) && $subtotal >= $condition['min_total']) {
                if ($minTotalRule->discount_type === 'percentage') {
                    $total -= $subtotal * ($minTotalRule->amount / 100);
                } elseif ($minTotalRule->discount_type === 'fixed') {
                    $total -= $minTotalRule->amount;
                }
            }
        }
        // 🔸 Apply user_type rule
        $userType = $this->userType;
        $userTypeRule = DiscountRule::where('type', 'user_type')->get()->first(function ($rule) use ($userType) {
            $condition = json_decode($rule->condition, true);

            return in_array($userType, (array) ($condition['user_type'] ?? []));
        });

        if ($userTypeRule) {
            if ($userTypeRule->discount_type === 'percentage') {
                $total -= $total * ($userTypeRule->amount / 100);
            } elseif ($userTypeRule->discount_type === 'fixed') {
                $total -= $userTypeRule->amount;
            }
        }

        return round(max($total, 0), 2);
    }

    public function syncWithSelectedProducts($selected)
    {
        // Remove prices of products that were deselected
        $this->productPrices = array_filter(
            $this->productPrices,
            fn($key) => in_array($key, $selected),
            ARRAY_FILTER_USE_KEY
        );
    }

}
