<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicamentsCategory extends Model
{
    protected $table = 'medicament_categories';
    protected $fillable = [
        'name'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function inquiries()
    {
        return $this->hasMany(MedicamentInquiry::class);
    }
}
