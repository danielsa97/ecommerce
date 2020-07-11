<?php


namespace App\Services\Widget;


use App\Models\Category;
use Illuminate\Http\JsonResponse;

class WidgetCategoryCounterService implements WidgetInterface
{

    public static function run(): JsonResponse
    {
        return response()->json(Category::query()->count());
    }
}
