<?php


namespace App\Services\Catalog\Category;


use App\Models\Category;
use App\Services\StatusService;
use App\Services\StoreInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class CategoryStoreService implements StoreInterface
{

    public static function store(array $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $request['status_id'] = StatusService::get('general', 'A')->id;
            $category = Category::query()->create(Arr::except($request, 'departments'));
            $category->departments()->sync($request['departments']);
            DB::commit();
            return new JsonResponse($category);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "message" => "Falha no cadastro da categoria",
            ], 500));
        }
    }
}
