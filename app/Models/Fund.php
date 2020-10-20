<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
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
