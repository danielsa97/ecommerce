<?php


namespace App\Services\Setting\Ecommerce;


use App\Models\Ecommerce;

class EcommerceUpdateSessionService
{

    public static function run()
    {
        $ecommerce = Ecommerce::query()->first();
        session()->put('brand', $ecommerce->brand->name ?? null);
        session()->put('favicon', $ecommerce->favicon->name ?? null);
        session()->put('ecommerce_id', $ecommerce->id);
        session()->save();
    }
}
