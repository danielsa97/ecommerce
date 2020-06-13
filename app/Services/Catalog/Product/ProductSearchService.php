<?php


namespace App\Services\Catalog\Skus;


use App\Http\Resources\Catalog\Category\CategorySearchResource;
use App\Models\Category;
use App\Models\Product;
use App\Services\SearchInterface;
use App\Services\StatusService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

class ProductSearchService implements SearchInterface
{

    public static function search(Request &$request): JsonResponse
    {
        try {
            $statusId = StatusService::get('general', 'A')->id;
            $query = Product::query()->where('status_id', $statusId);
            if ($request->search) {
                $query = $query->where('name', 'like', "%{$request->search}%");
            }
            if ($request->product_id) {
                $query = $query->where('id', '!=', $request->product_id);
            }
            return response()->json(CategorySearchResource::collection($query->limit(10)->get()));
        } catch (Exception $exception) {
            throw  new HttpResponseException(response()->json([
                "success" => false,
                "message" => $exception->getMessage(),
            ], 500));
        }
    }
}
