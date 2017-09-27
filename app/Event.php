<?php

namespace App;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Event extends Model
{
    //use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    //protected $dates = ['deleted_at'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = ['timeline_id', 'type', 'user_id', 'start_date', 'end_date', 'active', 'invite_privacy', 'timeline_post_privacy','location','group_id'];

    public function timeline()
    {
        return $this->belongsTo('App\Timeline');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'event_user', 'event_id', 'user_id');
    }

    public function is_admin($user_id)
    {
        $chk_isadmin = $this->where('user_id', $user_id)->first();

        $result = $chk_isadmin ? true : false;

        return $result;
    }

    public function is_eventadmin($user_id, $event_id)
    {
        $chk_isadmin = $this->where('id', $event_id)->where('user_id', $user_id)->first();

        $result = $chk_isadmin ? true : false;
        
        return $result;
    }

    public function guests($id)
    {
        $guests = $this->users()->where('user_id', '!=', $id)->get();

        $result = $guests ? $guests : false;

        return $result;
    }

    public function hostedByName($id)
    {
        $result = '';
        $user = User::find($id);
        if ($user) {
            $result = $user->timeline->name;
        }

        return $result;
    }

    public function hostedByUsername($id)
    {
        $result = '';
        $user = User::find($id);
        if ($user) {
            $result = $user->timeline->username;
        }

        return $result;
    }

   //  public function chkAvatar($id)
   //  {
   //   $result = '';
   //   $user = User::find($id);
   //   $timeline = $user->timeline;
   //   if($timeline && $timeline->avatar)
   //   {
   //     $result = $timeline->avatar->source;
   //   }
   //   else
   //   {
   //     $result = false;
   //   }

   //   return $result;
   // }

    public function isExpire($id)
    {
        $chkExpire = $this->find($id);
        if (date('Y-m-d H:i', strtotime($chkExpire->end_date)) > date('Y-m-d H:i', strtotime(Carbon::now()))) {
             return true;
        } else {
             return false;
        }
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function chkAvatar($id)
    {
         $result = '';
         $user = User::find($id);
         $timeline = $user->timeline;
        if ($timeline && $timeline->avatar) {
            $result = $timeline->avatar->source;
        } else {
            $result = false;
        }

         return $result;
    }
}
