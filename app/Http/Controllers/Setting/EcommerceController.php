<?php


namespace App\Http\Controllers\Setting;


use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\EcommerceGeneralRequest;
use App\Services\Setting\Ecommerce\EcommerceEditService;
use App\Services\Setting\Ecommerce\EcommerceUpdateGeneralService;

class EcommerceController extends Controller
{

    public function index()
    {
        return EcommerceEditService::get(session('ecommerce_id'));
    }

    public function updateGeneral(EcommerceGeneralRequest $request)
    {
        return EcommerceUpdateGeneralService::update(session('ecommerce_id'), $request->all());
    }

    public function updateAddressAndContact(EcommerceGeneralRequest $request)
    {
//        return EcommerceUpdateGeneralService::store($request->all());
    }
}
