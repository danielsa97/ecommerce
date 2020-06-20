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
        return view('catalog.category.index', [
            'categoryDataTable' => $this->categoryDataTable->html()
        ]);
    }

    public function store(CategoryRequest $request)
    {
        return CategoryStoreService::store($request->only('name', 'description', 'category_id', 'department_id'));
    }

    public function edit(int $id)
    {
        return CategoryEditService::get($id);
    }

    public function update(CategoryRequest $request, int $id)
    {
        return CategoryUpdateService::update($id, $request->only('name', 'description', 'category_id', 'department_id'));
    }

    public function changeStatus(int $categoryId)
    {
        return CategoryChangeStatusService::change($categoryId);
    }

    public function categoryDatatableAjax()
    {
        return $this->categoryDataTable->ajax();

    }

    public function categorySearch(Request $request, $search = null)
    {
        return CategorySearchService::search($request, $search);
    }
}
