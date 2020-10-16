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
