<?php


namespace App\Services\Catalog\Department;


use App\Models\Department;
use App\Services\SearchInterface;
use App\Services\StatusService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;
use Illuminate\Http\Exceptions\HttpResponseException;


class DepartmentSearchService implements SearchInterface
{
    public static function search(Request &$request): JsonResponse
    {
        try {

            $statusId = StatusService::get('general', 'A')->id;
            $query = Department::query()->where('status_id', $statusId);
            if ($src = mb_strtolower($request->search)) {
                $query = $query->whereRaw('lower(name) like (?)', ["%$src%"]);
            }
            return response()->json($query->select('id as code', 'name as label')->limit(10)->get());
        } catch (Exception $exception) {
            throw  new HttpResponseException(response()->json([
                "message" => $exception->getMessage(),
            ], 500));
        }
    }
}
