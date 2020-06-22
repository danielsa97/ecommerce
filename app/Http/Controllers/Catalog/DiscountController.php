<?php

namespace App\Http\Controllers\Catalog;

use App\DataTables\Catalog\DiscountDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Services\DataTableService;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    private $discountDataTable;

    public function __construct(DiscountDataTable $discountDataTable)
    {
        $this->discountDataTable = $discountDataTable;
    }


    public function discountDatatableAjax()
    {
        return DataTableService::make($this->discountDataTable);
    }

    public static function store(DiscountRequest $request)
    {
        dd($request->all());
    }

    public static function edit(int $id)
    {

    }
}
