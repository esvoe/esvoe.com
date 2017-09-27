<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use App\Event;
use Carbon\Carbon;

class Group extends Model
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
    protected $fillable = ['timeline_id', 'type', 'active', 'member_privacy', 'post_privacy','event_privacy'];

    /**
     * Get the user's  name.
     *
     * @param string $value
     *
     * @return string
     */
    public function getNameAttribute($value)
    {
        return $this->timeline->name;
    }

    /**
     * Get the user's  username.
     *
     * @param string $value
     *
     * @return string
     */
    public function getUsernameAttribute($value)
    {
        return $this->timeline->username;
    }

    /**
     * Get the user's  avatar.
     *
     * @param string $value
     *
     * @return string
     */
    public function getAvatarAttribute($value)
    {
        return $this->timeline->avatar ? $this->timeline->avatar->source : null;
    }

    /**
     * Get the user's  cover.
     *
     * @param string $value
     *
     * @return string
     */
    public function getCoverAttribute($value)
    {
        return $this->timeline->cover ? $this->timeline->cover->source : null;
    }

    /**
     * Get the user's  about.
     *
     * @param string $value
     *
     * @return string
     */
    public function getAboutAttribute($value)
    {
        return $this->timeline->about ? $this->timeline->about : null;
    }

    public function toArray()
    {
        $array = parent::toArray();

        $timeline = $this->timeline->toArray();

        foreach ($timeline as $key => $value) {
            if ($key != 'id') {
                $array[$key] = $value;
            }
        }

        return $array;
    }

    public function timeline()
    {
        return $this->belongsTo('App\Timeline');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'group_user', 'group_id', 'user_id')->withPivot('status', 'user_id', 'role_id');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function roleName($role_id)
    {
        $role = Role::find($role_id);
        $result = $role ? $role->name : false;

        return $result;
    }

    public function is_admin($user_id)
    {
        $admin_role_id = Role::where('name', 'admin')->first();
        $groupUser = $this->users()->where('user_id', $user_id)->where('role_id', $admin_role_id->id)->where('status', 'approved')->first();

        $result = $groupUser ? true : false;

        return $result;
    }

    public function pending_members()
    {
        $user_role_id = Role::where('name', 'user')->first();
        $pending_members = $this->users()->where('role_id', $user_role_id->id)->where('status', 'pending')->get();

        $result = $pending_members ? $pending_members : false;

        return $result;
    }

    public function members()
    {
        $admin_role_id = Role::where('name', '=', 'admin')->first();
        $members = $this->users()->where('role_id', '!=', $admin_role_id->id)->where('status', 'approved')->get();

        $result = $members ? $members : false;

        return $result;
    }

    public function admins()
    {
        $admin_role_id = Role::where('name', '=', 'admin')->first();
        $admins = $this->users()->where('role_id', $admin_role_id->id)->where('status', 'approved')->get();

        $result = $admins ? $admins : false;

        return $result;
    }

    // public function pending_users()
    // {
    //     $admin_role_id = Role::where('name', '=', 'admin')->first();
    //     $pending_users = $this->users()->where('role_id','!=',$admin_role_id->id)->where('status','pending')->get();
    //     $result = $pending_users ? $pending_users : false;
    //     return $result;
    // }

    public function chkGroupUser($group_id, $user_id)
    {
        $group_user = DB::table('group_user')->where('group_id', $group_id)->where('user_id', $user_id)->first();
        $result = $group_user ? $group_user : false;

        return $result;
    }

    public function updateStatus($group_user_id)
    {
        $group_user = DB::table('group_user')->where('id', $group_user_id)->update(['status' => 'approved']);
        $result = $group_user ? true : false;

        return $result;
    }

    public function decilneRequest($group_user_id)
    {
        $group_user = DB::table('group_user')->where('id', $group_user_id)->delete();
        $result = $group_user ? true : false;

        return $result;
    }

    public function removeMember($group_id, $user_id)
    {
        // $group_user = DB::table('group_user')->where('group_id',$group_id)->where('user_id', $user_id)
        //                 ->update(array('deleted_at' => DB::raw('NOW()')));
        $group_user = DB::table('group_user')->where('group_id', $group_id)->where('user_id', $user_id)->delete();

        $result = $group_user ? true : false;

        return $result;
    }

    public function updateMemberRole($member_role, $group_id, $user_id)
    {
        $group_user = DB::table('group_user')->where('group_id', $group_id)->where('user_id', $user_id)->update(['role_id' => $member_role]);
        $result = $group_user ? true : false;

        return $result;
    }

    public function getEvents()
    {
        $events =  Event::where('group_id', $this->id)->get();
        $result = $events ? $events : false;
        return $result;
    }

    public function getOnGoingEvents($group_id)
    {
        $ongoing_events = [];
        $events =  Event::where('group_id', $group_id)->get();
        if ($events) {
            foreach ($events as $event) {
                if ((date('Y-m-d', strtotime($event->start_date)) <= date('Y-m-d', strtotime(Carbon::now()))) &&
                (date('Y-m-d', strtotime($event->end_date)) >= date('Y-m-d', strtotime(Carbon::now())))
                  ) {
                    array_push($ongoing_events, $event);
                }
            }
        }

        $result = $ongoing_events ? $ongoing_events : false;
        return $result;
    }

    public function getUpcomingEvents($group_id)
    {
        $upcoming_events = [];
        $events =  Event::where('group_id', $group_id)->get();
        if ($events) {
            foreach ($events as $event) {
                if (date('Y-m-d', strtotime($event->start_date)) > date('Y-m-d', strtotime(Carbon::now()))) {
                    array_push($upcoming_events, $event);
                }
            }
        }
       
        $result = $upcoming_events ? $upcoming_events : false;
        return $result;
    }

    public function getGroupCount($group_id)
    {
        $users = DB::table('group_user')
        ->select(DB::raw('count(*) as user_count, group_id'))
        ->where('group_id', $group_id)
        ->groupBy('group_id')
        ->first();
      
        $result = $users ? $users : false;
        return $result;
    }
}
