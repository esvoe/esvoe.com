<?php

namespace App;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Application extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    // redirect table
    protected $table = 'apps';

    protected $casts = [
        'is_active' => 'boolean',
        'is_visible' => 'boolean',
        'auth_dispatch_changes' => 'boolean',
        //'permissions' => 'array',
        'settings' => 'array',
        //'rating' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo('App\ApplicationCategory');
    }

    public function getRatingPackedAttribute($value) {
        $rating = $this->rating;
        $rating_value = number_format($rating['value'], 1);
        $rating_total = $rating['total'];
        if ($rating_total == 0) {
            return $this->id.'#0#0#0*0*0*0*0#0*0*0*0*0';
        }
        $rate_count = implode($rating['rates'],'*');
        $rate_procs = array();
        foreach ($rating['rates'] as $k=>$v) {
            $rate_procs[(string)$k] = number_format(($v / $rating_total) * 100, 2);
        }
        $rate_procs = implode($rate_procs,'*');
        return implode([$this->id, $rating_value, $rating_total, $rate_count, $rate_procs],'#');
    }

    public function getRatingAttribute($value) {
        if ( ! $value) {
            return array(
                'value' => 0,
                'total' => 0,
                'rates' => array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0)
            );
        }
        return json_decode($value, true);
    }

    public function setRatingAttribute($value) {
        if (! is_array($value)) {
            $value = array(
                'value' => 0,
                'total' => 0,
                'rates' => array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0)
            );
        }
        $this->attributes['rating'] = json_encode($value);
    }

    public function getPermissionsAttribute($value) {
        if ( ! $value) return array();
        return json_decode($value, true);
    }

    public function setPermissionsAttribute($value) {
        if ( ! is_array($value)) $value = array();
        $this->attributes['permissions'] = json_encode($value);
    }

    /**
     * @param $source array|\Illuminate\Http\UploadedFile|null
     * @return string|null
     */
    public function uploadImageIcon($source)
    {

        if (!$source) return null;

        $image = Image::make($source->getRealPath());

        $imageName = 'icon_' . $this->id . '@40x40.jpg';
        $imagePath = 'apps';

        $image->resize(40, 40);

        File::exists(storage_path('uploads' . DIRECTORY_SEPARATOR . $imagePath)) or File::makeDirectory(storage_path('uploads' . DIRECTORY_SEPARATOR . $imagePath), 0755, true);

        $imageFilePathName = $imagePath . DIRECTORY_SEPARATOR . $imageName;

        $image->save(storage_path('uploads' . DIRECTORY_SEPARATOR . $imageFilePathName), 95);
        return $imageFilePathName;
    }

    /**
     * @param $source array|\Illuminate\Http\UploadedFile|null
     * @return string|null
     */
    public function uploadImageMain($source)
    {

        if (!$source) return null;

        $image = Image::make($source->getRealPath());

        $imageName = 'main_' . $this->id . '@270x270.jpg';
        $imagePath = 'apps';

        $image->resize(270, 270);

        File::exists(storage_path('uploads' . DIRECTORY_SEPARATOR . $imagePath)) or File::makeDirectory(storage_path('uploads' . DIRECTORY_SEPARATOR . $imagePath), 0755, true);

        $imageFilePathName = $imagePath . DIRECTORY_SEPARATOR . $imageName;

        $image->save(storage_path('uploads' . DIRECTORY_SEPARATOR . $imageFilePathName), 95);
        return $imageFilePathName;
    }

    /**
     * @param $source array|\Illuminate\Http\UploadedFile|null
     * @return string|null
     */
    public function uploadImagePromo($source)
    {

        if (!$source) return null;

        $image = Image::make($source->getRealPath());

        $imageName = 'promo_' . $this->id . '@540x376.jpg';
        $imagePath = 'apps';

        $image->resize(540, 376);

        File::exists(storage_path('uploads' . DIRECTORY_SEPARATOR . $imagePath)) or File::makeDirectory(storage_path('uploads' . DIRECTORY_SEPARATOR . $imagePath), 0755, true);

        $imageFilePathName = $imagePath . DIRECTORY_SEPARATOR . $imageName;

        $image->save(storage_path('uploads' . DIRECTORY_SEPARATOR . $imageFilePathName), 95);
        return $imageFilePathName;

    }

    public function dispatchSocialEvent($type, $data)
    {
        if ( ! $this->api_url ) {
            return;
        }

        $time = time();
        $sign = sha1($this->id . $type . $time . $this->api_key);

        $payload = array(
            'type' => $type,
            'data' => $data,
            'time' => $time,
            'sign' => $sign
        );

        $client = new \GuzzleHttp\Client([
            'http_errors' => false,
            'allow_redirects' => false,
            'connect_timeout' => 30, // - wait connect for
            'timeout' => 30, // - wait data for
            'headers' => [
                'User-Agent' => 'esvoe.client.api/1.0',
                'Accept' => 'application/json',
                'Referer' => URL::to('/')
            ],
        ]);

        try {
            $client->postAsync($this->api_url, [
                'http_errors' => false,
                'json' => $payload,
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            \Log::error($exception->getMessage(), $exception->getTrace());
        }
    }

    public function updateRating() {

        $rates = array();
        $total = 0;
        $value = 0;

        for ($i = 1; $i <= 5; $i++) {
            $rates[$i] = DB::table('app_users')
                ->whereNull('deleted_at')
                ->where('authorized', true)
                ->where('banned', false)
                ->where('app_id', $this->id)
                ->where('rating', $i)
                ->count('id');
            $total += $rates[$i];
            $value += $rates[$i] * $i;
        }

        if ($total > 0) {
            $value /= $total;
        }
        $this->rating = array(
            'value' => $value,
            'total' => $total,
            'rates' => $rates
        );
    }

    public function updateUserCount() {
        $this->count_users = DB::table('app_users')
            ->whereNull('deleted_at')
            ->where('authorized', true)
            ->where('banned', false)
            ->where('app_id', $this->id)
            ->count('id');
    }

    public function linkUser($user, $permissions = array(), $params = array(), $updateStats = false, $dispatchEvent = false) {

        if ( ! $user ) {

            return false;
        }

        $applicationUser = ApplicationUser::withTrashed()
            ->where('app_id', $this->id)
            ->where('user_id', $user->id)
            ->first();

        if ( ! $applicationUser ) {
            $applicationUser = new ApplicationUser();
            $applicationUser->app_id = $this->id;
            $applicationUser->user_id = $user->id;
            $applicationUser->banned = false;
            $applicationUser->authorized = false;
            $applicationUser->save();
        }

        if ( ! $applicationUser->banned ) {
            return false;
        }

        if ( $applicationUser->authorized ) {

            $this->permissions = array_merge(['authorize'], $this->permissions, $permissions);

            if ($this->isDirty('permissions')) {

                ApplicationLog::addApplicationUserChangePermissions($this, $user, $permissions);

                $this->update();
            }

            if ($dispatchEvent) {
                $this->dispatchSocialEvent('user.change.permissions', array(
                    'user_id' => $user->id,
                    'params' => $params,
                    'permissions' => $this->permissions
                ));
            }

            return true;
        }

        if ( $applicationUser->trashed() ) {
            $applicationUser->restore();
        }

        $applicationUser->authorized = true;
        $applicationUser->permissions = array_merge(['authorize'], $this->permissions, $permissions);
        $applicationUser->sessings = array(
            'auth_token' => bin2hex(random_bytes(17)),
            'static_token' => bin2hex(random_bytes(17)),
            'link_params' => $params
        );

        $applicationUser->update();

        if ( $updateStats ) {
            $this->updateUserCount();
            $this->updateRating();
            $this->update();
        }

        ApplicationLog::addApplicationUserLink($this, $user, $permissions);

        if ( $dispatchEvent ) {

            $this->dispatchSocialEvent('user.link', array(
                'user_id' => $user->id,
                'auth_token' => $applicationUser->settings['auth_token'],
                'params' => $params
            ));
        }

        return true;
    }

    public function unlinkUser($user, $params = array(), $updateStats = false, $dispatchEvent = false) {

        if ( ! $user ) {

            return false;
        }

        $applicationUser = ApplicationUser::where('app_id', $this->id)
            ->where('user_id', $user->id)
            ->first();

        if ( ! $applicationUser ) {

            return false;
        }

        if ( ! $applicationUser->authorized ) {

            return false;
        }

        $applicationUser->authorized = false;
        $applicationUser->permissions = array();
        $applicationUser->update();
        $applicationUser->delete();

        if ( $updateStats ) {
            $this->updateUserCount();
            $this->updateRating();
            $this->update();
        }

        ApplicationLog::addApplicationUserUnlink($this, $user);

        if ( $dispatchEvent ) {
            $this->dispatchSocialEvent('user.unlink', array(
                'user_id' => $user->id,
                'params' => $params
            ));
        }

        return true;
    }


}
