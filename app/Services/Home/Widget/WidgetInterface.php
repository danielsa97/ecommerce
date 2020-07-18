<?php


namespace App\Services\Home\Widget;

use Illuminate\Http\JsonResponse;

interface WidgetInterface
{
    public static function run(): JsonResponse;
}
