<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FundSeeder::class);
        $this->call(MedicamentsCategorySeeder::class);
        $this->call(UserSeeder::class);

        $this->call(InquirySeeder::class);
        $this->call(NomenclatureSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductsForVivaFundSeeder::class);
    }
}
