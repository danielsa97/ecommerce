<?php


namespace App\Services\Catalog\Category;


use App\Services\EditInterface;
use Illuminate\Http\JsonResponse;

class CategoryEditService extends CategoryService implements EditInterface
{
    /**
     * @param int $id
     * @return JsonResponse
     */
    public static function get(int $id): JsonResponse
    {
        $category = self::find($id);
        return new JsonResponse($category);
    }
}
