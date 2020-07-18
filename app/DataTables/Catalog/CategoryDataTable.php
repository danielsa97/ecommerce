<?php

namespace App\DataTables\Catalog;


use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->escapeColumns([])
            ->addColumn('action', function ($query) {
                return "
                    <div class='dropdown'>
                      <button class='btn btn-sm btn-primary dropdown-toggle' data-toggle='dropdown'>Ações</button>
                      <div class='dropdown-menu'>
                        <button class='dropdown-item' data-emit='edit' data-id='{$query->id}'>Editar</button>
                        <button class='dropdown-item' data-emit='change-status' data-id='{$query->id}'>Alterar Status</button>
                      </div>
                    </div>";
            })
            ->addColumn('department', function ($category) {
                return view('datatable.catalog.category.departments-label', ['departments' => $category->departments->pluck('name')]);
            })
            ->editColumn('status', 'datatable.status-label');
    }


    public function query(Category $model)
    {
        return $model->join('status', 'categories.status_id', 'status.id')
            ->leftJoin('categories as parent', 'categories.category_id', 'parent.id')
            ->select('categories.id', 'parent.name as parent_category', 'categories.name', 'categories.description', 'status.description as status');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('category_datatable')
            ->columns($this->getColumns())
            ->parameters($this->getBuilderParameters());
    }


    protected function getColumns()
    {
        return [
            'action' => [
                'title' => 'Ações',
                'orderable' => false,
                'searchable' => false,
                'exportable' => false,
                'printable' => false,
                'width' => '60px'
            ],
            'name' => ['title' => 'Nome', 'width' => '200px',],
            'description' => ['title' => 'Descrição', 'name' => 'categories.description'],
            'department' => ['title' => 'Departamento', 'orderable' => false, 'searchable' => false],
            'parent_category' => ['title' => 'Categoria Pai', 'name' => 'parent.name'],
            'status' => ['title' => 'Status', 'name' => 'status.description', 'width' => '50px', 'class' => 'text-center']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'catalog_brand_' . date('YmdHis');
    }
}
