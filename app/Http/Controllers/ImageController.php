<?php


namespace App\Http\Controllers;


use App\Services\GetImageService;

class ImageController extends Controller
{
    public function index()
    {
        return GetImageService::get();
    }
}
