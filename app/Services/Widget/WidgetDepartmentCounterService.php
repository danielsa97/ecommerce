<?php


namespace App\Services\Widget;


use App\Models\Department;
use Illuminate\Http\JsonResponse;

class WidgetDepartmentCounterService implements WidgetInterface
{

    public static function run(): JsonResponse
    {
        return response()->json(Department::query()->count());
    }
}
