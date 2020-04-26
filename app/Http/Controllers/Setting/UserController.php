<?php


namespace App\Http\Controllers\Setting;


use App\DataTables\Setting\UserDataTable;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    private $userDataTable;

    public function __construct(UserDataTable $userDataTable)
    {
        $this->userDataTable = $userDataTable;
    }

    public function index()
    {
        return $this->userDataTable->render('setting.user.index');
    }
}
