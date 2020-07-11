<?php


namespace App\Services\Catalog\Brand;


use App\Models\Brand;
use App\Services\StatusService;
use App\Services\StoreInterface;
use App\Traits\ImageStorageTrait;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class BrandStoreService implements StoreInterface
{

    use ImageStorageTrait;

    public static function store(array $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $statusAtivoId = StatusService::get('general', 'A')->id;
            $request['status_id'] = $statusAtivoId;
            $brand = Brand::query()->create(Arr::except($request, 'image'));
            $image = self::getInformationOrStore($request['image']);
            $image['status_id'] = $statusAtivoId;
            $brand->image()->create($image);

            DB::commit();
            return new JsonResponse($brand);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "message" => "Falha no cadastro de marca",
            ], 500));
        }
    }
}
