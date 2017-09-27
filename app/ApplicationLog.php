<?php
namespace App;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class ApplicationLog extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'app_logs';

    protected $casts = [
        'payload' => 'array'
    ];

    public function application()
    {
        return $this->belongsTo('App\Application', 'app_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }





    // loggers
    public static function addApplicationUserChangePermissions($application, $user, $permissions) {
        $record = new self();
        $record->app_id = $application->id;
        $record->user_id = $user->id;
        $record->type = 1000;
        $record->payload = array(
            'permissions' => $permissions,
        );
        $record->save();
    }

    public static function addApplicationUserLink($application, $user, $permissions, $params = array()) {
        $record = new self();
        $record->app_id = $application->id;
        $record->user_id = $user->id;
        $record->type = 1501;
        $record->payload = array(
            'permissions' => $permissions,
            'params' => $params
        );
        $record->save();
    }

    public static function addApplicationUserUnlink($application, $user, $params = array()) {
        $record = new self();
        $record->app_id = $application->id;
        $record->user_id = $user->id;
        $record->type = 1502;
        $record->payload = array(
            'params' => $params
        );
        $record->save();
    }

}
