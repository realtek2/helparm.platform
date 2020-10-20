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
                'name' => 'Бинты',
                'fund_id' => 1,
                'category_id' => 1,
                'quantity' => 100,
                'unit' => 'шт',
                'free' => 100,
            ],
            [
                'name' => 'Шприцы',
                'fund_id' => 1,
                'category_id' => 1,
                'quantity' => 500,
                'unit' => 'шт',
                'free' => 500,
            ],
            [
                'name' => 'Вода',
                'fund_id' => 1,
                'category_id' => 2,
                'quantity' => 250,
                'unit' => 'шт',
                'free' => 250,
            ],
            [
                'name' => 'Амоксиклав',
                'fund_id' => 3,
                'category_id' => 1,
                'quantity' => 100,
                'unit' => 'шт',
                'free' => 100,
            ],
            [
                'name' => 'Бинт марлевый',
                'fund_id' => 3,
                'category_id' => 1,
                'quantity' => 500,
                'unit' => 'шт',
                'free' => 500,
            ],
            [
                'name' => 'Гель для рук',
                'fund_id' => 3,
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
