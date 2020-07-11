<?php


namespace App\Services\Widget;

use Illuminate\Http\JsonResponse;

interface WidgetInterface
{
    public static function run(): JsonResponse;
}
