<?php


namespace App\Services;


use Illuminate\Http\JsonResponse;

interface SearchInterface
{
    public static function search(array $request = []): JsonResponse;
}
