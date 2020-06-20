<?php


namespace App\Traits;


use App\Services\StatusService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

trait ChangeGeneralStatusTrait
{
    public static function change($id): JsonResponse
    {
        try {
            $model = self::find($id);
            $newStatus = StatusService::get('general', $model->status->value === 'A' ? 'I' : 'A');
            if ($newStatus) {
                $model->status_id = $newStatus->id;
                $model->save();
                return new JsonResponse($model);
            }
            throw new Exception("Status inválido", 500);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "message" => $exception->getMessage(),
            ], $exception->getCode()));
        }
    }
}
