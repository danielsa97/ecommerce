<?php


namespace App\Services\Catalog\Department;


use App\Http\Resources\Catalog\Brand\BrandSearchResource;
use App\Models\Brand;
use App\Services\SearchInterface;
use App\Services\StatusService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;
use Illuminate\Http\Exceptions\HttpResponseException;


class BrandSearchService implements SearchInterface
{
    public static function search(Request &$request): JsonResponse
    {
        try {

            $statusId = StatusService::get('general', 'A')->id;
            $query = Brand::query()->where('status_id', $statusId);
            if ($search = mb_strtolower($request->search)) {
                $query = $query->whereRaw('lower(name) like (?)', ["%$search%"]);
            }
            return response()->json(BrandSearchResource::collection($query->limit(10)->get()));
        } catch (Exception $exception) {
            throw  new HttpResponseException(response()->json([
                "message" => $exception->getMessage(),
            ], 500));
        }
    }
}
