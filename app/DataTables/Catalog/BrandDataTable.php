<?php

namespace App\DataTables\Catalog;


use App\Models\Brand;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Services\DataTable;

class BrandDataTable extends DataTable
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
                        <a class='dropdown-item' href='{$query->id}'><i class='fa fa-edit'></i> Editar </a>
                        <a class='dropdown-item' href='{$query->id}'><i class='fa fa-adjust'></i> Alterar Status </a>
                      </div>
                    </div>";
            })
            ->editColumn('status', 'datatable.status-label');

    }


    public function query(Brand $brand)
    {
        return $brand->newQuery()
            ->join('status', 'brands.status_id', 'status.id')
            ->select('name', 'brands.description', 'status.description as status');
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->ajax(['url' => route('datatable.catalog.brand')])
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
            'description' => ['title' => 'Descrição'],
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
