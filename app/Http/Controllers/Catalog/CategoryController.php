<?php


namespace App\Http\Controllers\Catalog;


use App\DataTables\Catalog\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\Catalog\Category\CategoryChangeStatusService;
use App\Services\Catalog\Category\CategoryEditService;
use App\Services\Catalog\Category\CategorySearchService;
use App\Services\Catalog\Category\CategoryStoreService;
use App\Services\Catalog\Category\CategoryUpdateService;
use App\Services\DataTableService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryDataTable;

    public function __construct(CategoryDataTable $categoryDataTable)
    {
        $this->categoryDataTable = $categoryDataTable;
    }

    public function index()
    {
        return DataTableService::make($this->categoryDataTable);
    }

    public function store(CategoryRequest $request)
    {
        return CategoryStoreService::store($request->only('name', 'description', 'category_id', 'departments'));
    }

    public function edit(int $id)
    {
        return CategoryEditService::get($id);
    }

    public function update(CategoryRequest $request, int $id)
    {
        return CategoryUpdateService::update($id, $request->only('name', 'description', 'category_id', 'departments'));
    }

    public function changeStatus(int $categoryId)
    {
        return CategoryChangeStatusService::change($categoryId);
    }


    public function categorySearch(Request $request)
    {
        return CategorySearchService::search($request);
    }
}
