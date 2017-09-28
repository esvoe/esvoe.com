<?php
namespace App;

use Eloquent as Model;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Timeline",
 *      required={},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="username",
 *          description="username",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="about",
 *          description="about",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="avatar_id",
 *          description="avatar_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="cover_id",
 *          description="cover_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="cover_position",
 *          description="cover_position",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="string"
 *      )
 * )
 */
class Timeline extends Model
{

    public $table = 'timelines';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    //protected $dates = ['deleted_at'];


    public $fillable = [
        'username',
        'name',
        'about',
        'avatar_id',
        'cover_id',
        'cover_position',
        'type',
        'hide_cover',
        'background_id',
        'deleted_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'             => 'integer',
        'username'       => 'string',
        'name'           => 'string',
        'about'          => 'string',
        'avatar_id'      => 'integer',
        'cover_id'       => 'integer',
        'cover_position' => 'string',
        'type'           => 'string',
        'deleted_at'     => 'datetime',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [

    ];

    public function toArray()
    {
        $array = parent::toArray();

        $cover_url = $this->cover()->get()->toArray();
        $avatar_url = $this->avatar()->get()->toArray();
        $array['cover_url'] = $cover_url;
        $array['avatar_url'] = $avatar_url;

        if ($this->type == 'user') {
            $array['verified'] = $this->user()->first() ? $this->user()->first()->verified : 0;
        } else {
            $array['verified'] = $this->page()->first() ? $this->page()->first()->verified : 0;
        }

        return $array;
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function avatar()
    {
        return $this->belongsTo('App\Media', 'avatar_id');
    }

    public function cover()
    {
        return $this->belongsTo('App\Media', 'cover_id');
    }

    public function page()
    {
        return $this->hasOne('App\Page');
    }

    public function groups()
    {
        return $this->hasOne('App\Group');
    }

    public function reports()
    {
        return $this->belongsToMany('App\User', 'timeline_reports', 'timeline_id', 'reporter_id')->withPivot('status');
    }

    // public function events()
    // {
    //     return $this->belongsTo('App\Event', 'timeline_id');
    // }

    public function event()
    {
        return $this->hasOne('App\Event');
    }
    
    public function wallet()
    {
        return $this->hasOne('App\Wallet', 'timeline_id');
    }

    function gen_num()
    {
        $rand   = 0;
        for ($i = 0; $i<15; $i++) {
                $rand .= mt_rand(0, 9);
        }
        return $rand;
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification', 'timeline_id', 'id');
    }

    public function albums()
    {
        return $this->hasMany('App\Album');
    }

    public function wallpaper()
    {
        return $this->belongsTo('App\Media', 'background_id');
    } 

    public function saveWallpaper($wallpaper)
    {
        $strippedName = str_replace(' ', '', $wallpaper->getClientOriginalName());
        $photoName = date('Y-m-d-H-i-s').$strippedName;
        $photo = Image::make($wallpaper->getRealPath());
        $photo->save(storage_path().'/uploads/wallpapers/'.$photoName, 60);

        $media = Media::create([
          'title'  => $wallpaper->getClientOriginalName(),
          'type'   => 'image',
          'source' => $photoName,
        ]);
        
        $result = $this->update(['background_id' => $media->id]);
        
        $result = $result ? true : false;
        return $result;

    } 

    public function toggleWallpaper($action, $media)
    {
        if($action == 'activate'){
            
            $result = $this->update(['background_id' => $media->id]) ? 'activate' : false;
            return $result;
        }
        elseif($action == 'deactivate')
        {
            $result = $this->update(['background_id' => null]) ? 'deactivate' : false;
            return $result;
        }
        
    }
    
    /**
     * Create Timeline by current authorized user_id
     * @return Timeline | null
     */
    public static function makeFromAuth()
    {
        static $timeline = null; // Kind of cache

        // dd(Auth::user());
        // dd(Client::where(['user_id' => Auth::id()])->get());

        if ($timeline === null) {
            $timeline = Timeline::where(['id' => Auth::id()])->first();
        }
        
        return $client;
    }
    /**
     * Create Timeline by current authorized user_id
     * @return Timeline | null
     */
    public static function id()
    {
        $timeline = self::makeFromAuth();

        if ($timeline === null) {
            return 0;
        }
        
        return $timeline->getkey();
    }        
}
