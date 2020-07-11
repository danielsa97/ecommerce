<?php

namespace App\Http\Controllers\Catalog;

use App\DataTables\Catalog\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Services\Catalog\Skus\ProductSearchService;
use App\Services\DataTableService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productDataTable;

    public function __construct(ProductDataTable $productDataTable)
    {
        $this->productDataTable = $productDataTable;
    }

    public function index()
    {
        return DataTableService::make($this->productDataTable);
    }

    public function store()
    {
        return DataTableService::make($this->productDataTable);
    }

    public function productSearch(Request $request)
    {
        return ProductSearchService::search($request);
    }
}
