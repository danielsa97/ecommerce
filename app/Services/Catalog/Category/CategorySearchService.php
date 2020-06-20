<?php


namespace App\Services\Catalog\Category;


use App\Http\Resources\Catalog\Category\CategorySearchResource;
use App\Models\Category;
use App\Services\SearchInterface;
use App\Services\StatusService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

class CategorySearchService implements SearchInterface
{

    public static function search(Request &$request): JsonResponse
    {
        try {
            $statusId = StatusService::get('general', 'A')->id;
            $query = Category::query()->where('status_id', $statusId);
            if ($src = mb_strtolower($request->search)) {
                $query = $query->whereRaw('lower(name) like (?)', ["%$src%"]);
            }
            if ($request->category_id) {
                $query = $query->where('id', '!=', $request->category_id);
            }
            return response()->json($query->select('id as code', 'name as label')->limit(10)->get());
        } catch (Exception $exception) {
            throw  new HttpResponseException(response()->json([
                "message" => $exception->getMessage(),
            ], 500));
        }
    }
}
