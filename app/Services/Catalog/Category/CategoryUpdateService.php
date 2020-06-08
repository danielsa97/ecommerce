<?php


namespace App\Services\Catalog\Category;


use App\Services\UpdateInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class CategoryUpdateService extends CategoryService implements UpdateInterface
{

    /**
     * @param int $id
     * @param array $request
     * @return JsonResponse
     */
    public static function update(int $id, array $request): JsonResponse
    {
        try {
            $category = self::find($id);
            $category->update(array_filter($request));
            $category->save();
            return new JsonResponse($category);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "success" => false,
                "message" => "Falha na atualização da categoria",
            ], 500));
        }
    }
}
