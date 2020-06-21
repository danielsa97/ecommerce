<?php

namespace App\DataTables\Catalog;


use App\Models\Department;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Services\DataTable;

class DepartmentDataTable extends DataTable
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
            ->editColumn('status', 'datatable.status-label');

    }


    public function query(Department $brand)
    {
        return $brand->newQuery()
            ->join('status', 'departments.status_id', 'status.id')
            ->select('departments.id', 'name', 'departments.description', 'status.description as status');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('department_datatable')
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
            'description' => ['title' => 'Descrição', 'name' => 'departments.description'],
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
        return 'catalog_department_' . date('YmdHis');
    }
}
