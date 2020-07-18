<?php


namespace App\Services\Catalog\Category;


use App\Services\UpdateInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class CategoryUpdateService extends CategoryService implements UpdateInterface
{

    /**
     * @param int $id
     * @param array $request
     * @return JsonResponse
     */
    public static function update(int $id, array $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $category = self::find($id);
            $category->update(Arr::except($request, 'departments'));
            $category->save();
            $category->departments()->sync($request['departments']);
            DB::commit();
            return CategoryEditService::get($id);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "message" => "Falha na atualização da categoria",
            ], 500));
        }
    }
}
