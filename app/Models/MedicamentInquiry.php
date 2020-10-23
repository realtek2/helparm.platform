<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicamentInquiry extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'request_to_all',
        'quantity',
        'category_id',
        'fund_id',
        'created_by_fund'
    ];

    const NEW_INQUIRY = 1;
    const IN_PROCESS = 2;
    const ARCHIVED = 3;

    public const STATUSES = [
        self::NEW_INQUIRY => 'Новый',
        self::IN_PROCESS => 'В работе',
        self::ARCHIVED => 'Архив',
    ];

    public function medicamentsCategory()
    {
        return $this->belongsTo(MedicamentsCategory::class, 'category_id', 'id');
    }
    
    public function fund()
    {
        return $this->belongsTo(Fund::class);
    }

    public function createdByFund()
    {
        return $this->belongsTo(Fund::class, 'created_by_fund', 'id');
    }
    
    public function answers()
    {
        return $this->hasMany(Answer::class, 'id', 'inquiry_id');
    }
}
