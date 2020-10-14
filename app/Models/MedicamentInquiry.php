<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicamentInquiry extends Model
{
    protected $fillable = [
        'name',
        'description',
        'request_to_all',
        'quantity',
        'category_id',
        'fund_id'
    ];

    public function medicamentsCategory()
    {
        return $this->belongsTo(MedicamentsCategory::class, 'category_id', 'id');
    }
    
    public function fund()
    {
        return $this->belongsTo(Fund::class);
    }
}
