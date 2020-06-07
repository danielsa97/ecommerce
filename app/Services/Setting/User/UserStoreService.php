<?php


namespace App\Services\Setting\User;


use App\Services\StatusService;
use App\Services\StoreInterface;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

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
        } catch (Throwable $throwable) {
            Log::error($throwable->getMessage());
            return new JsonResponse($throwable->getMessage(), $throwable->getCode());
        }
    }
}
