<?php

namespace App\Models;

use App\Models\ProductAnswer;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'inquiry_id',
        'fund_id',
        'comment',
        'delivery_period',
        'quantity'
    ];

    public function productAnswers()
    {
        return $this->hasMany(ProductAnswer::class);
    }

    public function fund()
    {
        return $this->belongsTo(Fund::class);
    }

    public function inquiry()
    {
        return $this->belongsTo(MedicamentInquiry::class, 'inquiry_id', 'id');
    }
}
