<?php

namespace App\DataTables\Setting;

use App\User;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)->addColumn('action', function ($query) {
            return "
            <div class='dropdown'>
              <button class='btn btn-sm btn-primary dropdown-toggle' data-toggle='dropdown'>Ações</button>
              <div class='dropdown-menu'>
                <a class='dropdown-item' href='{$query->id}'><i class='fa fa-edit'></i> Editar </a>
                <a class='dropdown-item' href='{$query->id}'><i class='fa fa-adjust'></i> Alterar Status </a>
              </div>
            </div>
            ";
        })->editColumn('active', function ($q) {
            $response = (object)[
                'class' => $q->active == true ? 'badge-success' : 'badge-danger',
                'label' => $q->active == true ? 'Ativo' : 'Inativo'
            ];
            return "<span class='badge {$response->class}'>{$response->label}</span>";
        })->escapeColumns([]);
    }


    public function query()
    {
        return User::query()->select('id', 'name', 'email', 'active');
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
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
            'name' => ['title' => 'Nome'],
            'email' => ['title' => 'E-mail'],
            'active' => ['title' => 'Status', 'width' => '50px', 'class' => 'text-center']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'setting_user_' . date('YmdHis');
    }
}
