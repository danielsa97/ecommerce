<?php


namespace App\Services\Setting\Ecommerce;


use App\Models\Ecommerce;
use Illuminate\Http\JsonResponse;

class EcommerceEditService
{
    /**
     * @return JsonResponse
     */
    public static function get(): JsonResponse
    {
        $ecommerce = Ecommerce::query()->with(['mails', 'brand', 'favicon', 'phones', 'addresses', 'tags'])->first();
        return new JsonResponse($ecommerce);
    }
}
