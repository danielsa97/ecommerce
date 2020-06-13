<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Services\Catalog\Skus\ProductSearchService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productSearch(Request $request)
    {
        return ProductSearchService::search($request);
    }
}
