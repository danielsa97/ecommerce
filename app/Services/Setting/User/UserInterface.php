<?php


namespace App\Services\Setting\User;


use App\User;

interface UserInterface
{
    /**
     * @param int $id
     * @return User
     */
    public static function find(int $id): User;
}
