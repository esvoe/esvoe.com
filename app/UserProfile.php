<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends Model
{
    use SoftDeletes;

    protected $table = 'user_profiles';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function toArray() {
        $array= parent::toArray();

        $avatar = empty($this->avatar)
            ? 'default-' . $this->gender . '-avatar.png'
            : $this->avatar;

        $array['avatar'] = url('user/avatar/' . $avatar);

        return $array;
    }

}
