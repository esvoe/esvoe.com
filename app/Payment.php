<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    const STATUS_PENDING    = 0;
    const STATUS_APPROVED   = 1;
    const STATUS_DECLINED   = -1;

    protected $table = 'payments';

    protected $fillable = ['amount', 'currency', 'description', 'status', 'timeline_id', 'payment_method'];

    public function timeline()
    {
        return $this->belongsTo('App\Timeline', 'id', 'timeline_id');
    }
}
