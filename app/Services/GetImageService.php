<?php


namespace App\Services;

use Illuminate\Support\Facades\File;
use Mockery\Exception;

class GetImageService
{
    private static function getImageResponse($image)
    {
        $path = storage_path("app/image/$image");
        if (!file_exists($path)) {
            $path = storage_path("app/image/default_image.png");
        }

        $file = File::get($path);
        $type = File::mimeType($path);
        return response()->stream(function () use ($file) {
            echo $file;
        }, 200, ["Content-Type" => $type]);
    }

    public static function get()
    {
        try {
            $imageName = request()->route()->parameter('image');
            return self::getImageResponse($imageName);
        } catch (Exception $exception) {

        }

    }
}
