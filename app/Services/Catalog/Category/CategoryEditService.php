<?php


namespace App\Services\Catalog\Category;


use App\Http\Resources\Catalog\Category\CategorySearchResource;
use App\Http\Resources\Catalog\Department\DepartmentSearchResource;
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
        $category->category = new CategorySearchResource($category->parent()->first());
        $category->department = new DepartmentSearchResource($category->department()->first());
        return new JsonResponse($category);
    }
}
