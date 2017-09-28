<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use SoftDeletes;

    public $table = 'announcements';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'description',
        'image',
        'start_date',
        'end_date',
        'active',
        'deleted_at',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'announcement_user', 'announcement_id', 'user_id');
    }

    public function chkAnnouncementExpire($id)
    {
        $current_date = date('Y-m-d', strtotime(Carbon::now()));
        $announcement = self::find($id);

        if ($announcement->start_date < $announcement->end_date && $current_date <= $announcement->end_date) {
            return 'notexpired';
        } else {
            return 'expired';
        }
    }
}
