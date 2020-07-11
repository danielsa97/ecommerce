<?php


namespace App\Services\Widget;


use App\Models\Brand;
use Illuminate\Http\JsonResponse;

class WidgetBrandCounterService implements WidgetInterface
{

    public static function run(): JsonResponse
    {
        return response()->json(Brand::query()->count());
    }
}
