<?php


namespace App\Services\Catalog\Department;


use App\Models\Department;
use App\Services\StatusService;
use App\Services\StoreInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class DepartmentStoreService implements StoreInterface
{

    public static function store(array $request): JsonResponse
    {
        try {
            $request['status_id'] = StatusService::get('general', 'A')->id;
            $department = Department::query()->create($request);
            return new JsonResponse($department);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "success" => false,
                "message" => "Falha no cadastro do departamento",
            ], 500));
        }
    }
}
