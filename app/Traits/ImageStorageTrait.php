<?php


namespace App\Traits;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait ImageStorageTrait
{
    protected static function findOrStore(UploadedFile $image)
    {
        $response['name'] = $image->getClientOriginalName();
        $response['path'] = 'image/' . $response['name'];
        if (!file_exists(storage_path('app/' . $response['path']))) {
            $response['name'] = sha1(Str::random(40));
            $response['path'] = $image->storeAs('image', $response['name']);
        }
        return $response;
    }
}
