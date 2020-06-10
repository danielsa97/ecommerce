<?php


namespace App\Services;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface SearchInterface
{
    public static function search(Request &$request): JsonResponse;
}
