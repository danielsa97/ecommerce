<?php


namespace App\Services\Catalog\Brand;


use App\Services\UpdateInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class BrandUpdateService extends BrandService implements UpdateInterface
{

    /**
     * @param int $id
     * @param array $request
     * @return JsonResponse
     */
    public static function update(int $id, array $request): JsonResponse
    {
        try {
            $brand = self::find($id);
            $brand->update(array_filter($request));
            $brand->save();
            return new JsonResponse($brand);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "success" => false,
                "message" => "Falha na atualização da marca",
            ], 500));
        }
    }
}
