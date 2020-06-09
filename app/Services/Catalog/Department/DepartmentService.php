<?php


namespace App\Services\Catalog\Department;


use App\Models\Department;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

abstract class DepartmentService implements DepartmentInterface
{

    public static function find(int $id): Department
    {
        try {
            $department = Department::find($id);
            if ($department) {
                return $department;
            }
            throw new Exception("Departamento não encontrado", 500);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "success" => false,
                "message" => $exception->getMessage(),
            ], $exception->getCode()));
        }
    }
}
