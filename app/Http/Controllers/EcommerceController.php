<?php


namespace App\Http\Controllers;

use App\Services\GetEcommerceInformationService;

class EcommerceController extends Controller
{
    public function getInfo()
    {
        return GetEcommerceInformationService::get();
    }
}
