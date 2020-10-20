<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'fund_id',
        'category_id',
        'name',
        'quantity'
    ];

    const MEDICAMENTS = 1;
    const FOOD = 2;
    const FINANCIAL_AID = 3;

    public $prdocuts_category = [
        self::MEDICAMENTS => 'Медикаменты',
        self::FOOD => 'Продукты питания',
        self::FINANCIAL_AID => 'Финансовая помощь'
    ];

    public function fund()
    {
        return $this->belongsTo(Fund::class);
    }

    public function medicamentsCategory()
    {
        return $this->belongsTo(MedicamentsCategory::class, 'category_id', 'id');
    }

    public function productAnswer()
    {
        return $this->hasOne(ProductAnswer::class);
    }
}
