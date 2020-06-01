<?php


namespace App\Services\Setting\User;


use App\Services\EditInterface;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Throwable;

class UserEdit implements EditInterface
{
    public static function get(int $id): JsonResponse
    {
        try {
            $user = User::query()->find($id);
            if ($user) {
                return new JsonResponse($user);
            }
            throw new Exception("Usuário não encontrado", 500);
        } catch (Throwable $throwable) {
            Log::error($throwable->getMessage());
            return new JsonResponse($throwable->getMessage(), $throwable->getCode());
        }
    }
}
