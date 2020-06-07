<?php


namespace App\Services\Setting\User;


use App\Services\StatusService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class UserChangeStatusService extends UserService
{
    public static function change($id): JsonResponse
    {
        try {
            $user = self::find($id);
            $newStatus = StatusService::get('general', $user->status->value === 'A' ? 'I' : 'A');
            if ($newStatus) {
                $user->status_id = $newStatus->id;
                $user->save();
                return new JsonResponse($user);
            }
            throw new Exception("Status inválido", 500);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "success" => false,
                "message" => $exception->getMessage(),
            ], $exception->getCode()));
        }
    }
}
