<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'creator_id', 'type',
    ];

    public function messages()
    {
        return $this->hasMany('App\Message')->latest();
    }

    public function latest_message()
    {
        // $messages = $this->messages()->first();
        return $this->hasMany('App\Message')->orderBy('created_at', 'desc');
    }

    public function users()
    {
        return  $this->belongsToMany('App\User', 'conversation_user', 'conversation_id', 'user_id');
    }
}
