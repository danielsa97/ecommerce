<?php

namespace App\DataTables\Catalog;

use App\Models\Discount;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DiscountDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'discount.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Discount $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Discount $discount)
    {
        return $discount->newQuery()
            ->join('status', 'discounts.status_id', 'status.id')
            ->select('discounts.id', 'discounts.value', 'discounts.type', 'voucher', 'status.description as status');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('discount_datatable')
            ->columns($this->getColumns())
            ->ajax(['url' => route('datatable.catalog.discount')])
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
            'value' => ['title' => 'Valor', 'name' => 'discounts.value', 'width' => '200px'],
            'voucher' => ['title' => 'Voucher'],
            'tipo' =>  ['tittle' => 'Tipo', 'name' => 'discounts.type'],
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
        return 'Discount_' . date('YmdHis');
    }
}
