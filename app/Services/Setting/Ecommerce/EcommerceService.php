<?php


namespace App\Services\Setting\Ecommerce;


use App\Models\Ecommerce;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

abstract class EcommerceService implements EcommerceInterface
{

    public static function find(int $id): Ecommerce
    {
        try {
            $store = Ecommerce::find($id);
            if ($store) {
                return $store;
            }
            throw new Exception("Loja não encontrada", 500);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "message" => $exception->getMessage(),
            ], $exception->getCode()));
        }
    }
}
