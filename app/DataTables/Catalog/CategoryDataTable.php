<?php

namespace App\DataTables\Catalog;


use App\Models\Category;
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
                        <button class='dropdown-item' data-edit='{$query->id}'>Editar</button>
                        <button class='dropdown-item' data-change_status='{$query->id}'>Alterar Status</button>
                      </div>
                    </div>";
            })
            ->editColumn('status', 'datatable.status-label');

    }


    public function query(Category $brand)
    {
        return $brand->newQuery()
            ->join('status', 'categories.status_id', 'status.id')
            ->leftJoin('categories as parent', 'categories.category_id', 'parent.id')
            ->join('departments', 'categories.department_id', 'departments.id')
            ->select('departments.name as department','categories.id','parent.name as parent_category', 'categories.name', 'categories.description', 'status.description as status');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('category_datatable')
            ->columns($this->getColumns())
            ->ajax(['url' => route('datatable.catalog.category')])
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
            'department' => ['title' => 'Departamento', 'name' => 'departments.name'],
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
