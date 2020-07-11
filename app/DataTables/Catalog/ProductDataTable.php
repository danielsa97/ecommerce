<?php

namespace App\DataTables\Catalog;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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

    /**
     * Get query source of dataTable.
     *
     * @param Product $model
     * @return Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery()
            ->join('status', 'products.status_id', 'status.id')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->select(
                'products.name',
                'products.id',
                'brands.name as brand',
                'categories.name as category',
                'products.description',
                'status.description as status'
            );

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('product_datatable')
            ->columns($this->getColumns())
            ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
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
            'name' => ['title' => 'Nome', 'name' => 'products.name'],
            'description' => ['title' => 'Descrição', 'name' => 'products.description'],
            'category' => ['title' => 'Categoria', 'name' => 'categories.name'],
            'brand' => ['title' => 'Marca', 'name' => 'brands.name'],
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
        return 'catalog_product_' . date('YmdHis');
    }
}
