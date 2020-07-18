<?php


namespace App\Services\Home\Widget;


use App\User;
use Illuminate\Http\JsonResponse;

class WidgetUserSystemCounterService implements WidgetInterface
{

    public static function run(): JsonResponse
    {
        return response()->json(User::query()->count());
    }
}
