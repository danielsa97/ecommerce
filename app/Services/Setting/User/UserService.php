<?php


namespace App\Services\Setting\User;


use App\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

abstract class UserService implements UserInterface
{

    public static function find(int $id): User
    {
        try {
            $user = User::find($id);
            if ($user) {
                return $user;
            }
            throw new Exception("Usuário não encontrado", 500);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "message" => $exception->getMessage(),
            ], $exception->getCode()));
        }
    }
}
