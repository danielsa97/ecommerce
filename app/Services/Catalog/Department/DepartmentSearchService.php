<?php


namespace App\Services\Catalog\Department;


use App\Models\Department;
use App\Services\SearchInterface;
use Illuminate\Http\JsonResponse;
use Mockery\Exception;
use Illuminate\Http\Exceptions\HttpResponseException;


class SearchDepartmentService implements SearchInterface
{
    public static function search(array $request = []): JsonResponse
    {
        try {
            $search = $request['search'] ?? null;
            $query = Department::query();
            if ($search) {
                $query = $query->where('name', 'like', "%$search%");
            }
            $results = $query->select('id', 'name as text')->limit(10)->get()->toArray();
            return response()->json(['results' => $results]);
        } catch (Exception $exception) {
            throw  new HttpResponseException(response()->json([
                "success" => false,
                "message" => $exception->getMessage(),
            ], 500));
        }
    }
}