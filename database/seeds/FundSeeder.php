<?php

use App\Models\Fund;
use Illuminate\Database\Seeder;

class FundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $funds = [
            [
                'name' => 'Минздрав',
                'description' => 'Новый фонд',
                'address' => 'Россия, Москва',
                'number' => '987373604272',
                'email' => 'minzdrav@gmail.com',
            ],
            [
                'name' => 'Фонд Константина Хабенского',
                'description' => 'Новый фонд',
                'address' => 'Россия, Москва',
                'number' => '987373604272',
                'email' => 'minzdrav@gmail.com',
            ],
            [
                'name' => 'Фонд Честных партизан',
                'description' => 'Новый фонд',
                'address' => 'Россия, Москва',
                'number' => '987373604272',
                'email' => 'minzdrav@gmail.com',
            ],
            [
                'name' => 'Фонд 4',
                'description' => 'Новый фонд',
                'address' => 'Россия, Москва',
                'number' => '987373604272',
                'email' => 'minzdrav@gmail.com',
            ],
            [
                'name' => 'Фонд 5',
                'description' => 'Новый фонд',
                'address' => 'Россия, Москва',
                'number' => '987373604272',
                'email' => 'minzdrav@gmail.com',
            ],
        ];
        
        foreach ($funds as $fund) {
            Fund::create($fund);
        }
    }
}
