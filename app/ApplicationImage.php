<?php
/**
 * Created by PhpStorm.
 * User: zeratul
 * Date: 23.09.2017
 * Time: 23:52
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ApplicationImage extends Model
{
    public $timestamps = false;
    protected $table = 'app_images';


    public static function uploadScreenshot($source, $app_id) {
        if (!$source) return null;

        $image = Image::make($source->getRealPath());

        $imageName = 'screenshot_' . $app_id . '_'. time() . '@original.jpg';
        $imagePath = 'apps/screenshots';

        File::exists(storage_path('uploads' . DIRECTORY_SEPARATOR . $imagePath)) or File::makeDirectory(storage_path('uploads' . DIRECTORY_SEPARATOR . $imagePath), 0755, true);

        $imageFilePathName = $imagePath . DIRECTORY_SEPARATOR . $imageName;

        $image->save(storage_path('uploads' . DIRECTORY_SEPARATOR . $imageFilePathName), 95);

        $appImage = new ApplicationImage();
        $appImage->app_id = $app_id;
        $appImage->path = $imageFilePathName;

        $appImage->save();

        return $appImage;
    }

}