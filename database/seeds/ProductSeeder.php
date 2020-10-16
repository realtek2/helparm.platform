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
            ],
            [
                'name' => 'Шприцы',
                'fund_id' => 1,
                'category_id' => 1,
                'quantity' => 500,
            ],
            [
                'name' => 'Вода',
                'fund_id' => 1,
                'category_id' => 2,
                'quantity' => 250,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
