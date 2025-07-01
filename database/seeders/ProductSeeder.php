<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\DiscountRule;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $car = Product::create(['name' => 'Toy Car', 'base_price' => 100]);
        $truck = Product::create(['name' => 'Toy Truck', 'base_price' => 150]);

        $attributes = [
            ['group' => 'Size', 'value' => 'Small', 'price' => 0],
            ['group' => 'Size', 'value' => 'Big', 'price' => 20],
            ['group' => 'Color', 'value' => 'Black', 'price' => 0],
            ['group' => 'Color', 'value' => 'White', 'price' => 0],
            ['group' => 'Color', 'value' => 'Navy', 'price' => 10],
            ['group' => 'Color', 'value' => 'Cyan', 'price' => 10],
            ['group' => 'Color', 'value' => 'Red', 'price' => 10],
            ['group' => 'Material', 'value' => 'Plastic', 'price' => 0],
            ['group' => 'Material', 'value' => 'Aluminium', 'price' => 20],
        ];

        foreach ($attributes as $attr) {
            $attribute = Attribute::create($attr);
            $car->attributes()->attach($attribute);
            $truck->attributes()->attach($attribute);
        }

        // Discounts
        DiscountRule::create([
            'type' => 'attribute',
            'condition' => json_encode(['group' => 'Size', 'value' => 'Small']),
            'discount_type' => 'percentage',
            'amount' => 5,
        ]);

        DiscountRule::create([
            'type' => 'total',
            'condition' => json_encode(['min_total' => 200]),
            'discount_type' => 'fixed',
            'amount' => 10,
        ]);

        DiscountRule::create([
            'type' => 'user_type',
            'condition' => json_encode(['user_type' => 'company']),
            'discount_type' => 'percentage',
            'amount' => 20,
        ]);

        DiscountRule::create([
            'type' => 'attribute',
            'condition' => json_encode(['group' => 'Color', 'value' => 'Black']),
            'discount_type' => 'percentage',
            'amount' => 10,
        ]);
    }

}
