<?php

use App\Models\Nomenclature;
use Illuminate\Database\Seeder;

class NomenclatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nomenclatures = [
            ['name' => 'Бинты'],
            ['name' => 'Шприцы'],
            ['name' => 'Вода'],
            ['name' => 'Амоксиклав'],
            ['name' => 'Бинт марлевый'],
            ['name' => 'Гель для рук'],
        ];
        foreach ($nomenclatures as $nomenclature) {
            Nomenclature::create($nomenclature);
        }
    }
}
