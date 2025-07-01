<?php

namespace App\Livewire;

use App\Models\DiscountRule;
use Livewire\Component;
use App\Models\Product;
use App\Models\Attribute;

class ProductBox extends Component
{
    public $productId;
    public $product;
    public $userType;
    public $productAttributes = [];

    public $selectedAttributes = [];
    public $productAttributesByGroup = [];
    public $discount = 0;
    public $finalPrice = 0;

    public function mount($productId)
    {
        $this->product = Product::with('attributes')->findOrFail($productId);
        $this->productAttributes = $this->product->attributes;
        $this->productAttributesByGroup = collect($this->productAttributes)->groupBy('group')->toArray();
        $this->calculatePrice();
    }

    public function updatedSelectedAttributes()
    {
        $this->calculatePrice();
    }

    public function updatedDiscount()
    {
        $this->calculatePrice();
    }

    public function calculatePrice()
    {
        $basePrice = $this->product->base_price;
        $attributePrice = 0;
        $discountAmount = 0;

        // Flatten all attributes
        $allAttributes = collect($this->productAttributesByGroup)->flatten(1);

        // Apply attribute prices
        foreach ($this->selectedAttributes as $group => $valueId) {
            $attr = $allAttributes->firstWhere('id', $valueId);
            if ($attr && isset($attr['price'])) {
                $attributePrice += $attr['price'];
            }

            // 🔍 Apply attribute-based discounts from rules
            $discountRule = DiscountRule::where('type', 'attribute')
                ->whereJsonContains('condition->group', $group)
                ->whereJsonContains('condition->value', $attr['value'] ?? '')
                ->first();

            if ($discountRule) {
                if ($discountRule->discount_type === 'percentage') {
                    $discountAmount += ($basePrice + $attributePrice) * ($discountRule->amount / 100);
                } elseif ($discountRule->discount_type === 'fixed') {
                    $discountAmount += $discountRule->amount;
                }
            }
        }

        $subtotal = ($basePrice + $attributePrice) - $discountAmount;

        $this->finalPrice = round(max($subtotal, 0), 2); // prevent negative

        // Send subtotal (before min_total rule)
        $this->dispatch('product-price-updated', productId: $this->productId, price: $this->finalPrice);
    }

    public function render()
    {
        return view('livewire.product-box');
    }
}
