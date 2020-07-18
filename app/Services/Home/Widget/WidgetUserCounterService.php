<?php


namespace App\Services\Home\Widget;


use App\User;
use Illuminate\Http\JsonResponse;

class WidgetUserCounterService implements WidgetInterface
{

    public static function run(): JsonResponse
    {
        $total = User::query()
            ->join('profiles', 'users.profile_id', 'profiles.id')
            ->where('profiles.name', 'administrator')
            ->count();
        return response()->json($total);
    }
}
