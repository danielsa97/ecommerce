<?php


namespace App\Http\Controllers\Setting;


use App\DataTables\Setting\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\DataTableService;
use App\Services\Setting\User\UserChangeStatusService;
use App\Services\Setting\User\UserEditService;
use App\Services\Setting\User\UserStoreService;
use App\Services\Setting\User\UserUpdateService;

class UserController extends Controller
{

    private $userDataTable;

    public function __construct(UserDataTable $userDataTable)
    {
        $this->userDataTable = $userDataTable;
    }

    public function index()
    {
        return DataTableService::make($this->userDataTable);
    }

    public function store(UserRequest $request)
    {
        return UserStoreService::store($request->only('password', 'name', 'email'));
    }

    public function update(UserRequest $request, int $id)
    {
        return UserUpdateService::update($id, $request->only('password', 'name', 'email'));
    }


    public function edit(int $userId)
    {
        return UserEditService::get($userId);
    }

    public function changeStatus(int $userId)
    {
        return UserChangeStatusService::change($userId);
    }

}
