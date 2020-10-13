<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicamentsCategory extends Model
{
    protected $table = 'medicament_categories';
    protected $fillable = [
        'name'
    ];
}
