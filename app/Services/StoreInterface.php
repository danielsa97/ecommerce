<?php


namespace App\Services;


use Illuminate\Http\JsonResponse;

interface StoreInterface
{
    public static function store(array $request): JsonResponse;
}
