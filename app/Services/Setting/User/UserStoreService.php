<?php


namespace App\Services\Setting\User;


use App\Services\StatusService;
use App\Services\StoreInterface;
use App\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class UserStoreService implements StoreInterface
{
    /**
     * @param array $request
     * @return JsonResponse
     */
    public static function store(array $request): JsonResponse
    {
        try {
            $request['status_id'] = StatusService::get('general', 'A')->id;
            $user = User::query()->create($request);
            return new JsonResponse($user);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "message" => "Falha no cadastro de usuário",
            ], 500));
        }
    }
}
