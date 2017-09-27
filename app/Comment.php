<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    //use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    //protected $dates = ['deleted_at'];

    protected $fillable = ['post_id', 'description', 'user_id', 'parent_id', 'youtube_title', 'youtube_video_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments_liked()
    {
        return $this->belongsToMany('App\User', 'comment_likes', 'comment_id', 'user_id');
    }

    public function replies()
    {
        return $this->hasMany('App\Comment', 'parent_id', 'id');
    }

    public function user_hidden()
    {
        return $this->belongsToMany('App\User', 'hidden_comments', 'comment_id', 'user_id');
    }

    public function images()
    {
        return $this->belongsToMany('App\Media', 'comment_media', 'comment_id', 'media_id');
    }
}
