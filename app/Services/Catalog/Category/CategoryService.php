<?php


namespace App\Services\Catalog\Category;


use App\Models\Category;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

abstract class CategoryService implements CategoryInterface
{

    public static function find(int $id): Category
    {
        try {
            $category = Category::find($id);
            if ($category) {
                return $category;
            }
            throw new Exception("Categoria não encontrada", 500);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw new HttpResponseException(response()->json([
                "message" => $exception->getMessage(),
            ], $exception->getCode()));
        }
    }
}
