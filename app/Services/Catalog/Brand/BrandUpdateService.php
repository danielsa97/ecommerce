<?php


namespace App\Services\Catalog\Brand;


use App\Services\UpdateInterface;
use App\Traits\ImageStorageTrait;
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

    use ImageStorageTrait;


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
                $image = self::getInformationOrStore($request['image']);
                $brand->image()->update($image);
            }
            DB::commit();
            return BrandEditService::get($id);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "message" => "Falha na atualização da marca",
            ], 500));
        }
    }
}
