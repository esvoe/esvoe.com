<?php

namespace App;

use DB;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

//use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use Sluggable;
    //use SoftDeletes;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    // *
    //  * The attributes that should be mutated to dates.
    //  *
    //  * @var array
     
    // protected $dates = ['deleted_at'];

    /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
    protected $fillable = ['timeline_id', 'name', 'slug', 'about', 'privacy', 'active'];

    public function photos()
    {
        return $this->belongsToMany('App\Media', 'album_media', 'album_id', 'media_id');
    }

    public function previewImage()
    {
        return $this->belongsTo('App\Media', 'preview_id', 'id');
    }

    public function timeline()
    {
        return $this->belongsTo('App\Timeline', 'timeline_id', 'id');
    }
}
