<?php


namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Services\Home\Widget\WidgetService;

class WidgetController extends Controller
{

    public function index(string $name)
    {
        return WidgetService::get($name);
    }
}
