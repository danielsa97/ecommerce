<?php


namespace App\Services\Setting\Ecommerce;


use App\Models\Ecommerce;

interface EcommerceInterface
{
    /**
     * @param int $id
     * @return Ecommerce
     */
    public static function find(int $id): Ecommerce;
}
