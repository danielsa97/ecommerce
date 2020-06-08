<?php

namespace App\DataTables\Setting;

use App\User;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
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


    public function query(User $user)
    {
        return $user->newQuery()
            ->join('status', 'users.status_id', 'status.id')
            ->select('users.id', 'name', 'email', 'status.description as status');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('user_datatable')
            ->columns($this->getColumns())
            ->ajax(['url' => route('datatable.setting.user')])
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
        return 'setting_user_' . date('YmdHis');
    }
}
