<?php


namespace App\Services\Setting\User;


use App\Services\EditInterface;
use Illuminate\Http\JsonResponse;

class UserEditService extends UserService implements EditInterface
{
    /**
     * @param int $id
     * @return JsonResponse
     */
    public static function get(int $id): JsonResponse
    {
        $user = self::find($id);
        return new JsonResponse($user);
    }
}
