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

        // Track matching discount rules
        $matchedDiscountRules = [];

        // Apply attribute prices
        foreach ($this->selectedAttributes as $group => $valueId) {
            $attr = $allAttributes->firstWhere('id', $valueId);
            if ($attr && isset($attr['price'])) {
                $attributePrice += $attr['price'];
            }

            // Collect matching discount rules for this attribute
            if ($attr) {
                $rule = DiscountRule::where('type', 'attribute')->get()->first(function ($rule) use ($group, $attr) {
                    $condition = json_decode($rule->condition, true);
                    return in_array($group, (array) ($condition['group'] ?? [])) &&
                        in_array($attr['value'], (array) ($condition['value'] ?? []));
                });

                if ($rule) {
                    $matchedDiscountRules[] = $rule;
                }
            }
        }

        // Apply discounts after all prices calculated
        foreach ($matchedDiscountRules as $rule) {
            if ($rule->discount_type === 'percentage') {
                $discountAmount += ($basePrice + $attributePrice) * ($rule->amount / 100);
            } elseif ($rule->discount_type === 'fixed') {
                $discountAmount += $rule->amount;
            }
        }

        $subtotal = ($basePrice + $attributePrice) - $discountAmount;

        $this->finalPrice = round(max($subtotal, 0), 2); // ensure not negative

        $this->dispatch('product-price-updated', productId: $this->productId, price: $this->finalPrice);
    }

    public function render()
    {
        return view('livewire.product-box');
    }
}
