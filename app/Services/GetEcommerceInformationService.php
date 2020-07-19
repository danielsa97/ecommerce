<?php


namespace App\Services;


use App\Models\Ecommerce;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class GetEcommerceInformationService
{

    /**
     * @return JsonResponse
     */
    public static function get()
    {
        try {
            $ecommerce = Ecommerce::query()->with('brand', 'favicon')->first();
            if ($ecommerce) {
                return response()->json($ecommerce);
            }
            throw new Exception("E-commerce não encontrado");
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json($exception->getMessage(), $exception->getCode()));
        }
    }
}
