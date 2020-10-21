<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use Sortable;
    protected $fillable = [
        'fund_id',
        'category_id',
        'name',
        'quantity',
        'unit',
        'free',
        'reserve',
        'is_urgent'
    ];

    public $sortable = ['id'];

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

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $filter->apply($builder);
    }
}
