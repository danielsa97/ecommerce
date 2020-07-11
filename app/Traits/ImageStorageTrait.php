<?php


namespace App\Traits;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\StreamedResponse;

trait ImageStorageTrait
{
    /**
     * @param string|null $imageName
     * @return StreamedResponse
     */
    public static function getImage(string $imageName = null): StreamedResponse
    {
        $imageResponse = function ($image = 'default.png') {
            $path = storage_path("app/image/$image");
            $file = File::get($path);
            $type = File::mimeType($path);
            return response()->stream(function () use ($file) {
                echo $file;
            }, 200, ["Content-Type" => $type]);
        };
        try {

            $imageName = $imageName ?? request()->route()->parameter('image');
            if (file_exists(storage_path("app/image/$imageName"))) {
                return $imageResponse($imageName);
            }
            throw new Exception("Imagem \"$imageName\" não encontrada", 404);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $imageResponse();
        }
    }

    /**
     * @param UploadedFile $image
     * @return mixed|array
     */
    protected static function getInformationOrStore(UploadedFile $image): array
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
