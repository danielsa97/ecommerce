<?php


namespace App\Services\Widget;


use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;
use Mockery\Exception;

class WidgetService
{
    public static function get(string $name)
    {
        try {
            $class = "App\Services\Widget\Widget" . ucfirst(Str::camel($name)) . "Service";
            if (class_exists($class)) {
                return $class::run();
            }
            throw  new Exception("Widget $name não encontrado", 404);
        } catch (Exception $exception) {
            throw new HttpResponseException(response()->json([
                'message' => $exception->getMessage()
            ], 404));
        }

    }
}
