<?php


namespace App\Services\Catalog\Brand;


use App\Models\Brand;
use App\Services\StatusService;
use App\Services\StoreInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class BrandStoreService implements StoreInterface
{

    public static function store(array $request): JsonResponse
    {
        try {
            $request['status_id'] = StatusService::get('general', 'A')->id;
            $brand = Brand::query()->create($request);
            return new JsonResponse($brand);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "message" => "Falha no cadastro de marca",
            ], 500));
        }
    }
}
