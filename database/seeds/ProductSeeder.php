<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name_id' => 1,
                'fund_id' => 1,
                'category_id' => 1,
                'quantity' => 100,
                'unit' => 'шт',
                'free' => 100,
            ],
            [
                'name_id' => 2,
                'fund_id' => 1,
                'category_id' => 1,
                'quantity' => 500,
                'unit' => 'шт',
                'free' => 500,
            ],
            [
                'name_id' => 3,
                'fund_id' => 1,
                'category_id' => 2,
                'quantity' => 250,
                'unit' => 'шт',
                'free' => 250,
            ],
            [
                'name_id' => 4,
                'fund_id' => 3,
                'category_id' => 1,
                'quantity' => 100,
                'unit' => 'шт',
                'free' => 100,
            ],
            [
                'name_id' => 5,
                'fund_id' => 3,
                'category_id' => 1,
                'quantity' => 500,
                'unit' => 'шт',
                'free' => 500,
            ],
            [
                'name_id' => 6,
                'fund_id' => 3,
                'category_id' => 2,
                'quantity' => 250,
                'unit' => 'уп',
                'free' => 250,
            ],
            [
                'name_id' => 4,
                'fund_id' => 2,
                'category_id' => 1,
                'quantity' => 100,
                'unit' => 'шт',
                'free' => 100,
            ],
            [
                'name_id' => 5,
                'fund_id' => 2,
                'category_id' => 1,
                'quantity' => 500,
                'unit' => 'шт',
                'free' => 500,
            ],
            [
                'name_id' => 6,
                'fund_id' => 2,
                'category_id' => 2,
                'quantity' => 250,
                'unit' => 'уп',
                'free' => 250,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
