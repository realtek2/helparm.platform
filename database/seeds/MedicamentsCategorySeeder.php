<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicamentsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medicaments = [
            [
                'name' => 'Медикаменты',
            ],
            [
                'name' => 'Продукты питания',
            ],
            [
                'name' => 'Финансовая помощь',
            ],
        ];

        foreach ($medicaments as $medicament) {
            DB::table('medicament_categories')->insert($medicament);
        }
    }
}
