<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallpaper extends Model
{
    protected $fillable = [
        'title',
        'media_id'  

    ];

    public function media()
    {
    	return $this->belongsTo('App\Media');
    }

}
