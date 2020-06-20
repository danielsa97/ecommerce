<?php


namespace App\Services\Catalog\Brand;


use App\Models\Brand;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

abstract class BrandService implements BrandInterface
{

    public static function find(int $id): Brand
    {
        try {
            $brand = Brand::find($id);
            if ($brand) {
                return $brand;
            }
            throw new Exception("Marca não encontrada", 500);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "message" => $exception->getMessage(),
            ], $exception->getCode()));
        }
    }
}
