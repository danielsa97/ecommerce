<?php


namespace App\Services\Catalog\Discount;


use App\Models\Discount;
use App\Services\StatusService;
use App\Services\StoreInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class DiscountStoreService implements StoreInterface
{

    public static function store(array $request): JsonResponse
    {
        try {
            $request['status_id'] = StatusService::get('general', 'A')->id;
            $discount = Discount::query()->create($request);
            return new JsonResponse($discount);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "message" => "Falha no cadastro do disconto",
            ], 500));
        }
    }
}
