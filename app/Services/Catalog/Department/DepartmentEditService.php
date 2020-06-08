<?php


namespace App\Services\Catalog\Department;


use App\Services\EditInterface;
use Illuminate\Http\JsonResponse;

class DepartmentEditService extends DepartmentService implements EditInterface
{
    /**
     * @param int $id
     * @return JsonResponse
     */
    public static function get(int $id): JsonResponse
    {
        $department = self::find($id);
        return new JsonResponse($department);
    }
}
