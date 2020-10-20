<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fund extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'address',
        'number',
        'email'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
