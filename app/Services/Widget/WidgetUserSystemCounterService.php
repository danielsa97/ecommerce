<?php


namespace App\Services\Widget;


use App\User;
use Illuminate\Http\JsonResponse;

class WidgetUserSystemCounterService implements WidgetInterface
{

    public static function run(): JsonResponse
    {
        return response()->json(User::query()->count());
    }
}
