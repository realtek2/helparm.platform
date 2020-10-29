<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsForVivaFundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('max_execution_time', 0); // 0 = Unlimited
        DB::unprepared(file_get_contents(base_path('database/seeds/products.sql')));
    }
}
