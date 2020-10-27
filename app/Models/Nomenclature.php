<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nomenclature extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'name_id');
    }
}
