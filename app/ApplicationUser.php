<?php
namespace App;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class ApplicationUser extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'app_users';

    protected $casts = [
        'enabled' => 'boolean',
        'authorized' => 'boolean',
        'banned' => 'boolean',
        'permissions' => 'array',
        'settings' => 'array',
        'store' => 'array'
    ];

    public function application()
    {
        return $this->belongsTo('App\Application', 'app_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function applyRate($value) {
        $value = (int) $value;
        if ($value < 1 || $value > 5 || $value == $this->rate_value)
            return;
        $this->rate_value = $value;

        // write to application logs
        $actLog = new ApplicationLog();
        $actLog->app_id = $this->app_id;
        $actLog->user_id = $this->user_id;
        $actLog->type = 100;
        $actLog->payload = array(
            'type' => 'user.rate',
            'value' => $value
        );

    }



















}
