<?php

namespace App;

use LaravelBook\Ardent\Ardent;

class Transaction extends \LaravelArdent\Ardent\Ardent
{

    const STANDART = 'standart';
    const PAYMENT  = 'buy';
    const SELL     = 'sell';
    const WITHDRAW = 'withdraw';
    const MAILING  = 'mailing';

    protected $softDelete = true;
    
    protected $table = 'transactions';    
    
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public static $relationsData = array(
        'clientFrom'          => array(self::BELONGS_TO, 'Timeline', 'foreignkey' => 'client_from'),
        'clientTo'            => array(self::BELONGS_TO, 'Timeline', 'foreignkey' => 'client_to'),
    );
    
    public function getActionColorAttribute()
    {
        switch ($this->action)
        {
            case self::STANDART:
                $color = 'success';
                break;
            case self::PAYMENT:
                $color = 'purple-light';
                break;
            case self::WITHDRAW:
                $color = 'primary';
                break;
            case self::MAILING:
                $color = 'success';
                break;
            case self::SELL:
                $color = 'success';
                break;
            default:
                $color = 'purple';
        }

        return $color;
    }    
}
