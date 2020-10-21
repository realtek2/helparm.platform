<?php

use App\Models\MedicamentInquiry;
use Illuminate\Database\Seeder;

class InquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inquiries = [
            [
                'name' => 'Бинты',
                'fund_id' => 1,
                'created_by_fund' => 1,
                'category_id' => 1,
                'request_to_all' => 1,
                'description' => 'Актеры Тоби Магуайр и Эндрю Гарфилд, которые исполняли роли Человека-паука, снимутся вместе в третьей части фильма. Издание FandomWire сообщает, что Том Холланд также появится в боевике.

Отмечается, что героев перенесет в киновселенную наставник Человека-паука Доктор Стрэндж. Его сыграет Бенедикт Камбербэтч. Также в издании добавили, что Гарфилд и Магуайр появятся в фильме ближе к концу. Они станут помощниками Человека-паука.

Издание отмечает, что актеры уже подписали контракты. В фильме также сыграют Мариса Томей, Зендая, Джейкоб Баталон и другие. Однако официального подтверждения информации нет. Премьера, по сообщению издания, состоится в конце 2021 года.',
                'quantity' => 50,
            ],
            [
                'name' => 'Шприцы',
                'fund_id' => 3,
                'created_by_fund' => 1,
                'category_id' => 1,
                'request_to_all' => 0,
                'description' => 'Актеры Тоби Магуайр и Эндрю Гарфилд, которые исполняли роли Человека-паука, снимутся вместе в третьей части фильма. Издание FandomWire сообщает, что Том Холланд также появится в боевике.

Отмечается, что героев перенесет в киновселенную наставник Человека-паука Доктор Стрэндж. Его сыграет Бенедикт Камбербэтч. Также в издании добавили, что Гарфилд и Магуайр появятся в фильме ближе к концу. Они станут помощниками Человека-паука.

Издание отмечает, что актеры уже подписали контракты. В фильме также сыграют Мариса Томей, Зендая, Джейкоб Баталон и другие. Однако официального подтверждения информации нет. Премьера, по сообщению издания, состоится в конце 2021 года.',
                'quantity' => 250,
            ],
            [
                'name' => 'Вода',
                'fund_id' => 2,
                'created_by_fund' => 1,
                'category_id' => 2,
                'request_to_all' => 0,
                'description' => 'Актеры Тоби Магуайр и Эндрю Гарфилд, которые исполняли роли Человека-паука, снимутся вместе в третьей части фильма. Издание FandomWire сообщает, что Том Холланд также появится в боевике.

Отмечается, что героев перенесет в киновселенную наставник Человека-паука Доктор Стрэндж. Его сыграет Бенедикт Камбербэтч. Также в издании добавили, что Гарфилд и Магуайр появятся в фильме ближе к концу. Они станут помощниками Человека-паука.

Издание отмечает, что актеры уже подписали контракты. В фильме также сыграют Мариса Томей, Зендая, Джейкоб Баталон и другие. Однако официального подтверждения информации нет. Премьера, по сообщению издания, состоится в конце 2021 года.',
                'quantity' => 25,
            ],
        ];

        foreach ($inquiries as $inquiry) {
            MedicamentInquiry::create($inquiry);
        }
    }
}
