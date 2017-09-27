<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//use Illuminate\Database\Eloquent\SoftDeletes;

class ExchangeRate extends Model
{
    public $table = 'exchange_rates';

    protected $fillable = ['from', 'to', 'rate'];



    /*
    public function getRatesFor($currency) {
        $rates = ExchangeRate::where('from', $currency)
            //->orderBy('updated_at', 'desc')
            ->groupBy('to')
            ->latest()
            ->get();
        return $rates;
    }
    */
}
