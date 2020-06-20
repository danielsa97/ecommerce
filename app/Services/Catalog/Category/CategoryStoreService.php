<?php


namespace App\Services\Catalog\Category;


use App\Models\Category;
use App\Services\StatusService;
use App\Services\StoreInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class CategoryStoreService implements StoreInterface
{

    public static function store(array $request): JsonResponse
    {
        try {
            $request['status_id'] = StatusService::get('general', 'A')->id;
            $category = Category::query()->create($request);
            return new JsonResponse($category);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "message" => "Falha no cadastro da categoria",
            ], 500));
        }
    }
}
