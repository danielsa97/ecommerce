<?php


namespace App\Http\Controllers\Catalog;


use App\DataTables\Catalog\DepartmentDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Services\Catalog\Department\DepartmentChangeStatusService;
use App\Services\Catalog\Department\DepartmentEditService;
use App\Services\Catalog\Department\DepartmentSearchService;
use App\Services\Catalog\Department\DepartmentStoreService;
use App\Services\Catalog\Department\DepartmentUpdateService;
use App\Services\DataTableService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    private $departmentDataTable;

    public function __construct(DepartmentDataTable $departmentDataTable)
    {
        $this->departmentDataTable = $departmentDataTable;
    }

    public function index()
    {
        return DataTableService::make($this->departmentDataTable);
    }

    public function store(DepartmentRequest $request)
    {
        return DepartmentStoreService::store($request->only('name', 'description'));
    }

    public function edit(int $id)
    {
        return DepartmentEditService::get($id);
    }

    public function update(DepartmentRequest $request, int $id)
    {
        return DepartmentUpdateService::update($id, $request->only('name', 'description'));
    }

    public function changeStatus(int $departmentId)
    {
        return DepartmentChangeStatusService::change($departmentId);
    }

    public function departmentSearch(Request $request)
    {
        return DepartmentSearchService::search($request);
    }
}
