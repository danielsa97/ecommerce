<?php

namespace App\Http\Controllers\Catalog;

use App\DataTables\Catalog\DiscountDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    private $discountDataTable;

    public function __construct(DiscountDataTable $discountDataTable)
    {
        $this->discountDataTable = $discountDataTable;
    }

    public function index()
    {
        return view('catalog.discount.index', [
            'discountDataTable' => $this->discountDataTable->html()
        ]);
    }


    public static function store()
    {

    }

    public static function edit(int $id)
    {

    }
}
