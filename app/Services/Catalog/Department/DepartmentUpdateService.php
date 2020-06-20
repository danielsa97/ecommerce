<?php


namespace App\Services\Catalog\Department;


use App\Services\UpdateInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class DepartmentUpdateService extends DepartmentService implements UpdateInterface
{

    /**
     * @param int $id
     * @param array $request
     * @return JsonResponse
     */
    public static function update(int $id, array $request): JsonResponse
    {
        try {
            $department = self::find($id);
            $department->update($request);
            $department->save();
            return new JsonResponse($department);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "message" => "Falha na atualização do departamento",
            ], 500));
        }
    }
}
