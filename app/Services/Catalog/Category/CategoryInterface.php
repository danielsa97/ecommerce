<?php


namespace App\Services\Catalog\Category;


use App\Models\Category;

interface CategoryInterface
{
    /**
     * @param int $id
     * @return Category
     */
    public static function find(int $id): Category;
}
