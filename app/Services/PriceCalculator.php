<?php

namespace App\Services;

use App\Models\Attribute;
use App\Models\Product;
use App\Models\DiscountRule;

class PriceCalculator
{
    public function calculate(array $productIds, array $attributeMap, string $userType): array
    {
        $base = 0;
        $attributePrice = 0;
        $discounts = [];

        $products = Product::with('attributes')->whereIn('id', $productIds)->get();

        foreach ($products as $product) {
            $base += $product->base_price;
        }

        $selectedAttributes = Attribute::whereIn('id', collect($attributeMap)->values())->get();
        $attributePrice = $selectedAttributes->sum('price');

        $subTotal = $base + $attributePrice;
        $final = $subTotal;

        $rules = DiscountRule::all();

        foreach ($rules as $rule) {
            $apply = false;

            if ($rule->type === 'attribute') {
                $condition = json_decode($rule->condition, true);
                $matched = $selectedAttributes->first(fn($attr) => $attr->group === $condition['group'] &&
                    $attr->value === $condition['value']
                );
                $apply = !!$matched;
            }

            if ($rule->type === 'total') {
                $condition = json_decode($rule->condition, true);
                $apply = $subTotal >= ($condition['min_total'] ?? 0);
            }

            if ($rule->type === 'user_type') {
                $condition = json_decode($rule->condition, true);
                $apply = $userType === $condition['user_type'];
            }

            if ($apply) {
                $amount = $rule->amount;
                $desc = '';

                if ($rule->discount_type === 'percentage') {
                    $value = ($final * $amount) / 100;
                    $final -= $value;
                    $desc = "{$amount}% off";
                } else {
                    $value = $amount;
                    $final -= $value;
                    $desc = "{$amount} KD off";
                }

                $discounts[] = [
                    'label' => $desc,
                    'amount' => $value,
                ];
            }
        }

        return [
            'base_price' => $base,
            'attribute_price' => $attributePrice,
            'discounts' => $discounts,
            'final' => max($final, 0),
        ];
    }
}
