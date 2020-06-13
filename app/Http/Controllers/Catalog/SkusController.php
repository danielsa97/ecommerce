<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Services\Catalog\Skus\SkuSearchService;
use Illuminate\Http\Request;

class SkusController extends Controller
{
    public function sKusSearch(Request $request)
    {
        return SkuSearchService::search($request);
    }
}
