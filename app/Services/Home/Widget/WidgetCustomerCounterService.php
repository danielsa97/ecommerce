<?php


namespace App\Services\Home\Widget;


use App\User;
use Illuminate\Http\JsonResponse;

class WidgetCustomerCounterService implements WidgetInterface
{

    public static function run(): JsonResponse
    {
        $total = User::query()
            ->join('profiles', 'users.profile_id', 'profiles.id')
            ->where('profiles.name', 'customer')
            ->count();
        return response()->json($total);
    }
}
