<?php


namespace App\Http\Controllers\Catalog;


use App\DataTables\Catalog\BrandDataTable;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    private $brandDataTable;

    public function __construct(BrandDataTable $brandDataTable)
    {
        $this->brandDataTable = $brandDataTable;
    }

    public function index()
    {
        return view('catalog.brand.index', [
            'brandDataTable' => $this->brandDataTable->html()
        ]);
    }

    public function brandDatatableAjax()
    {
        return $this->brandDataTable->ajax();

    }
}
