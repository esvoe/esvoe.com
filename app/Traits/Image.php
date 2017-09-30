<?php

namespace app\Traits;

use Image as ImageInt;
use File;
use Storage;

trait Image
{

    function image($width = 0, $height = false, $disk, $source)
    {

        $image = Storage::disk($disk)->path($source);

        if(!File::isFile($image)){
            return false;
        }

        $dir = File::dirname($image);
        $folder =   '/' . $width . "x" . $height . '/';
        $dest = $dir . $folder;

        $filename = File::basename($source);
        $img = $dest . $filename;
        $destUrl = static_uploads($disk . '/' .File::dirname($source) . $folder . $filename);

        if (File::isFile($img)) {
            return $destUrl;
        }else{
            File::makeDirectory($dest,0777,true,true);
        }

        $img_obj = ImageInt::make($image);

        if ($height === 0) {
            $img_obj->width($width);
        } else {
            if ($width === 0) {
                $img_obj->height($height);
            } else {
                $img_obj->fit($width, $height, function ($constraint) {
                    $constraint->upsize();
                });
            }
        }

        $img_obj->save($img);

        return $destUrl;

    }

    public function deleteImg($image)
    {

        if (!is_dir($dir)) {
            return false;
        }

        foreach (\File::directories($dir) as $dir) {
            if (is_file($dir . "/" . $image)) {
                unlink($dir . "/" . $image);
            }
        }
    }

}