<?php

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
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
