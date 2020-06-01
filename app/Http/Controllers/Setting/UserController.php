<?php


namespace App\Http\Controllers\Setting;


use App\DataTables\Setting\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\Setting\User\UserEdit;
use App\Services\Setting\User\UserStore;
use App\Services\Setting\User\UserUpdate;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    private $userDataTable;

    public function __construct(UserDataTable $userDataTable)
    {
        $this->userDataTable = $userDataTable;
    }

    public function index()
    {
        return view('setting.user.index', [
            'userDataTable' => $this->userDataTable->html()
        ]);
    }

    public function store(UserRequest $request)
    {
        return UserStore::store($request->only('password', 'name', 'email'));
    }

    public function update(UserRequest $request, int $id)
    {
        return UserUpdate::update($id, $request->only('password', 'name', 'email'));
    }

    /**
     * @param int $userId
     * @return JsonResponse
     */
    public function edit(int $userId)
    {
        return UserEdit::get($userId);
    }

    /**
     * @return JsonResponse
     */
    public function userDatatableAjax()
    {
        return $this->userDataTable->ajax();
    }
}
