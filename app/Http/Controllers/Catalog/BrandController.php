<?php


namespace App\Http\Controllers\Catalog;


use App\DataTables\Catalog\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Services\Catalog\Brand\BrandChangeStatusService;
use App\Services\Catalog\Brand\BrandEditService;
use App\Services\Catalog\Brand\BrandStoreService;
use App\Services\Catalog\Brand\BrandUpdateService;
use App\Services\Catalog\Department\BrandSearchService;
use App\Services\DataTableService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    private $brandDataTable;

    public function __construct(BrandDataTable $brandDataTable)
    {
        $this->brandDataTable = $brandDataTable;
    }

    public function index()
    {
        return DataTableService::make($this->brandDataTable);
    }

    public function store(BrandRequest $request)
    {
        return BrandStoreService::store($request->only('name', 'description', 'image'));
    }

    public function edit(int $id)
    {
        return BrandEditService::get($id);
    }

    public function update(BrandRequest $request, int $id)
    {
        return BrandUpdateService::update($id, $request->only('name', 'description', 'image'));
    }

    public function changeStatus(int $brandId)
    {
        return BrandChangeStatusService::change($brandId);
    }

    public function brandSearch(Request $request)
    {
        return BrandSearchService::search($request);
    }
}
