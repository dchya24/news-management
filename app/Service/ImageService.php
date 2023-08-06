<?php
namespace App\Service;

use Illuminate\Http\UploadedFile;
Use Illuminate\Support\Str;

class ImageService {
  public static function uploadFromRequest(UploadedFile $image, $folder = null, $photo_name = null){
    $photo_name = $photo_name ? $photo_name : Str::random(40) .'.'. $image->getClientOriginalExtension();

    $folder = $folder ? $folder : 'images\news';
    $path = $image->move($folder, $photo_name);

    return $path;
  }

  public static function deleteImage($path){
    if(file_exists($path)){
      unlink(public_path($path));
    }
  }
}