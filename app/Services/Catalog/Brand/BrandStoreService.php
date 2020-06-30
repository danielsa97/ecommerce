<?php


namespace App\Services\Catalog\Brand;


use App\Models\Brand;
use App\Services\StatusService;
use App\Services\StoreInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Mockery\Exception;

class BrandStoreService implements StoreInterface
{

    private static function storeImage(array $request)
    {
        try {
            $response['name'] = sha1(Str::random(40));
            $response['path'] = $request['image']->storeAs('image', $response['name']);
            return $response;
        } catch (Exception $exception) {
            throw new HttpResponseException(response()->json([
                "message" => "Falha upload da imagem",
            ], 500));
        }
    }

    public static function store(array $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $statusAtivoId = StatusService::get('general', 'A')->id;
            $image = self::storeImage($request);
            $image['status_id'] = $statusAtivoId;
            $request['status_id'] = $statusAtivoId;
            $brand = Brand::query()->create(Arr::except($request, 'image'));
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
