<?php


namespace App\Services\Catalog\Department;


use App\Models\Department;

interface DepartmentInterface
{
    /**
     * @param int $id
     * @return Department
     */
    public static function find(int $id): Department;
}
