<?php

use App\Models\Customer;
use App\Models\Profile;
use App\Services\StatusService;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::query()->where('email', 'customer@customer.com')->first();
        Customer::query()->firstOrCreate([
            'name' => $user->name,
            'date_of_birth' => Carbon::now()->toDateString(),
            'document' => '02033531298',
            'gender' => Arr::random(['M', 'F']),
            'status_id' => StatusService::get('general', 'I')->id,
            'user_id' => $user->id
        ]);
    }
}
