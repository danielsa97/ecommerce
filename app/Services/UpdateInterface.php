<?php


namespace App\Services;

use Illuminate\Http\JsonResponse;

interface UpdateInterface
{
    public static function update(int $id, array $request): JsonResponse;
}
