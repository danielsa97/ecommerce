<?php


namespace App\Services\Setting\User;


use App\Services\UpdateInterface;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Throwable;

class UserUpdate implements UpdateInterface
{

    public static function update(int $id, array $request): JsonResponse
    {
        try {
            $user = User::query()->find($id);
            if ($user) {
                return new JsonResponse($user->update(array_filter($request)));
            }
            throw new Exception("Usuário não encontrado", 500);
        } catch (Throwable $throwable) {
            Log::error($throwable->getMessage());
            return new JsonResponse($throwable->getMessage(), $throwable->getCode());
        }
    }
}
