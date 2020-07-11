<?php

namespace App\Http\Controllers;


use App\Models\Ecommerce;

class HomeController extends Controller
{

    public function index()
    {

        return view('page', [
            'brand' => Ecommerce::query()->first()->brand->name ?? null
        ]);
    }
}
