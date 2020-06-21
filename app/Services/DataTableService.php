<?php


namespace App\Services;


use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Services\DataTable;

abstract class DataTableService
{
    /**
     * @param DataTable $dataTable
     * @return JsonResponse|string
     */
    public static function make(DataTable $dataTable)
    {
        if (request()->draw) {
            return $dataTable->ajax();
        }
        $builder = $dataTable->html();
        $builder->ajax(['url' => $builder->getAjaxUrl()]);
        return $builder->generateJson();
    }
}
