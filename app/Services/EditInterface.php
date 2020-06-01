<?php


namespace App\Services;


use Illuminate\Http\JsonResponse;

interface EditInterface
{
    public static function get(int $id): JsonResponse;
}
