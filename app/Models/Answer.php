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
        'quantity',
        'delivery_status',
        'delivery_sent_date',
        'date_of_receiving'
    ];

    protected $dates = ['delivery_sent_date', 'date_of_receiving'];

    const WAITING_FOR_CONFIRMATION_DELIVERY = 0;
    const DELIVERY_ANSWER_REGECTED = 1;
    const DELIVERY_ASNWER_CONFIRMED = 2;
    const DELIVERY_SENT = 3;
    const DELIVERED = 4;
    const NOT_DELIVERED = 5;

    public const STATUSES = [
        self::WAITING_FOR_CONFIRMATION_DELIVERY,
        self::DELIVERY_ANSWER_REGECTED,
        self::DELIVERY_ASNWER_CONFIRMED,
        self::DELIVERY_SENT,
        self::DELIVERED,
        self::NOT_DELIVERED
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
