<?php


namespace App\Services\Catalog\Brand;


use App\Models\Brand;

interface BrandInterface
{
    /**
     * @param int $id
     * @return Brand
     */
    public static function find(int $id): Brand;
}
