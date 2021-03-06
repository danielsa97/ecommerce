<?php


namespace App\Services\Catalog\Brand;


use App\Services\EditInterface;
use Illuminate\Http\JsonResponse;

class BrandEditService extends BrandService implements EditInterface
{
    /**
     * @param int $id
     * @return JsonResponse
     */
    public static function get(int $id): JsonResponse
    {
        $brand = self::find($id);
        $brand['image'] = $brand->image->name;
        return new JsonResponse($brand->withoutRelations());
    }
}
