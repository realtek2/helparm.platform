<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nomenclature extends Model
{
    use SoftDeletes;
    public $timestamps = false;

    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'name_id');
    }
}
