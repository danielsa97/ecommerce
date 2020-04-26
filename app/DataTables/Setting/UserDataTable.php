<?php

namespace App\DataTables\Setting;

use App\User;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query);
    }


    public function query()
    {
        return User::query()->select('name', 'email');
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->bu
            ->parameters($this->getBuilderParameters());
    }

    protected function getColumns()
    {
        return [
            ['data' => 'name', 'title' => 'Nome'],
            ['data' => 'email', 'title' => 'E-mail']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Setting_User_' . date('YmdHis');
    }
}
