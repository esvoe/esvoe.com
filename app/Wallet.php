<?php

namespace App;

use Eloquent as Model;

class Wallet extends Model
{    
    protected $table = 'wallets';
    
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

//    public $fillable = [
//        'bilance',
//        'timeline_id',
//    ];
    
    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [

    ];

    public function timeline()
    {
        return $this->belongsTo('App\Timeline');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
