<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

//use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
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
    protected $fillable = ['timeline_id', 'category_id', 'message_privacy', 'timeline_post_privacy', 'member_privacy', 'address', 'active', 'phone', 'website', 'verified'];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
    'name' => 'required',
    ];

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

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'page_user', 'page_id', 'user_id')->withPivot('role_id', 'active');
    }

    public function likes()
    {
        return $this->belongsToMany('App\User', 'page_likes', 'page_id', 'user_id');
    }

    public function is_admin($user_id)
    {
        $admin_role_id = Role::where('name', 'admin')->first();
        $pageUser = $this->users()->where('user_id', '=', $user_id)->where('role_id', '=', $admin_role_id->id)->where('page_user.active', 1)->first();


        $result = $pageUser ? true : false;

        return $result;
    }

    public function members()
    {
        $admin_role_id = Role::where('name', '=', 'admin')->first();
        $members = $this->users()->where('role_id', '!=', $admin_role_id->id)->where('page_user.active', 1)->get();

        $result = $members ? $members : false;

        return $result;
    }

    public function admins()
    {
        $admin_role_id = Role::where('name', '=', 'admin')->first();
        $admins = $this->users()->where('role_id', $admin_role_id->id)->where('page_user.active', 1)->get();

        $result = $admins ? $admins : false;

        return $result;
    }

    public function chkPageUser($page_id, $user_id)
    {
        $page_user = DB::table('page_user')->where('page_id', '=', $page_id)->where('user_id', '=', $user_id)->first();
        $result = $page_user ? $page_user : false;

        return $result;
    }

    public function updateStatus($page_user_id)
    {
        $page_user = DB::table('page_user')->where('id', $page_user_id)->update(['active' => 1]);
        $result = $page_user ? true : false;

        return $result;
    }

    public function updatePageMemberRole($member_role, $page_id, $user_id)
    {
        $page_user = DB::table('page_user')->where('page_id', $page_id)->where('user_id', $user_id)->update(['role_id' => $member_role]);
        $result = $page_user ? true : false;

        return $result;
    }

    public function removePageMember($page_id, $user_id)
    {
        $page_user = DB::table('page_user')->where('page_id', '=', $page_id)->where('user_id', '=', $user_id)->delete();

        $result = $page_user ? true : false;

        return $result;
    }

    public function getPageCount($page_id)
    {
        $users = DB::table('page_likes')
        ->select(DB::raw('count(*) as user_count, page_id'))
        ->where('page_id', $page_id)
        ->groupBy('page_id')
        ->first();
      
        $result = $users ? $users : false;
        return $result;
    }
}
