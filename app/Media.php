<?php

namespace App;

use App\Traits\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

//use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    //use SoftDeletes;
    use Image;

    // *
    //  * The attributes that should be mutated to dates.
    //  *
    //  * @var array

    // protected $dates = ['deleted_at'];

    protected $table = 'media';

    protected $fillable = ['title', 'type', 'source'];

    public function album()
    {
        return $this->hasOne('App\Album', 'id', 'preview_id');
    }

    public function albums()
    {
        return $this->belongsToMany('App\Album', 'album_media', 'media_id', 'album_id');
    }

    public function post()
    {
        return $this->belongsToMany('App\Post', 'post_media', 'media_id', 'post_id');
    }

    public function comment()
    {
        return $this->belongsToMany('App\Comment', 'comment_media', 'media_id', 'comment_id');
    }

    public function wallpaper()
    {
        return $this->belongTo('App\Wallpaper');
    }

    public function albumStore(string $username)
    {
        if ($this->type !== 'image') {
            return storage_path() . $this->source;
        }

        Storage::disk('albums')->makeDirectory(
            $username
            . '/'
            . substr($this->source, 0, strrpos($this->source, '/'))
        );
        return Storage::disk('albums')->path($username . '/' . $this->source);
    }

    public function albumUrl(int $userId, $width = false, $height = false)
    {
        if ($width or $height) {
            return $this->image($width, $height, 'albums', $userId . '/' . $this->source);
        }

        return Storage::disk('albums')->url($userId . '/' . $this->source);
    }
}
