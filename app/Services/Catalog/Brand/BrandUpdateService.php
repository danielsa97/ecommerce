<?php


namespace App\Services\Catalog\Brand;


use App\Models\Brand;
use App\Services\UpdateInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Mockery\Exception;

class BrandUpdateService extends BrandService implements UpdateInterface
{

    private static function updateImage(UploadedFile $image)
    {
        try {
            $response['name'] = sha1(Str::random(40));
            $response['path'] = $image->storeAs('image', $response['name']);
            return $response;
        } catch (Exception $exception) {
            throw new HttpResponseException(response()->json([
                "message" => "Falha upload da imagem",
            ], 500));
        }
    }

    /**
     * @param int $id
     * @param array $request
     * @return JsonResponse
     */
    public static function update(int $id, array $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $brand = self::find($id);
            $brand->update(Arr::except($request, 'image'));
            $brand->save();
            if (isset($request['image'])) {
                $image = self::updateImage($request['image']);
                $brand->image()->update($image);
            }
            DB::commit();
            return new JsonResponse($brand);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "message" => "Falha na atualização da marca",
            ], 500));
        }
    }
}
