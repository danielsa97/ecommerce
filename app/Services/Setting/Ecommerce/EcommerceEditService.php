<?php


namespace App\Services\Setting\Ecommerce;


use App\Services\EditInterface;
use Illuminate\Http\JsonResponse;

class EcommerceEditService extends EcommerceService implements EditInterface
{
    /**
     * @param int $id
     * @return JsonResponse
     */
    public static function get(int $id): JsonResponse
    {
        $ecommerce = self::find($id)->with(['mails', 'brand', 'favicon', 'phones', 'addresses', 'tags'])->first();
        return new JsonResponse($ecommerce);
    }
}
