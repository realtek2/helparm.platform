<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAnswer extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'comment',
        'delivery_period'
    ];

    public function inquiry()
    {
        return $this->belongsTo(MedicamentInquiry::class, 'inquiry_id', 'id');
    }
}
