<?php

namespace App\Models;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Model;

class ProductAnswer extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'comment',
        'delivery_period',
        'answer_id',
        'product_id'
    ];

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answer_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
