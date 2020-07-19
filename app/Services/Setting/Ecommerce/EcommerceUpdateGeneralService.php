<?php


namespace App\Services\Setting\Ecommerce;


use App\Models\Ecommerce;
use App\Services\StatusService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use App\Traits\ImageStorageTrait;

class EcommerceUpdateGeneralService
{
    use ImageStorageTrait;

    public static function update(array $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $ecommerce = Ecommerce::query()->first();
            $statusAtivoId = StatusService::get('general', 'A')->id;
            $store = function ($field) use (&$request, &$ecommerce, $statusAtivoId) {
                if (isset($request[$field]) && $request[$field] instanceof UploadedFile) {
                    $ecommerce->$field()->updateOrCreate(['group' => $field], [
                            'status_id' => $statusAtivoId,
                            'group' => $field,
                        ] + self::getInformationOrStore($request[$field])
                    );
                } else {
                    $ecommerce->$field()->delete();
                }
            };
            $store('brand');
            $store('favicon');
            $ecommerce->update(Arr::only($request, ['description', 'name']));
            DB::commit();
            return EcommerceEditService::get();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "message" => "Falha na atualização das configurações gerais da loja",
            ], 500));
        }
    }


}
