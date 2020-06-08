<?php

use App\Models\Customer;
use App\Models\Profile;
use App\Services\StatusService;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
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
        $user = User::whereEmail('customer@customer.com')->first();
        Customer::query()->firstOrCreate([
            'name' => $user->name,
            'date_of_birth' => Carbon::now()->toDateString(),
            'document' => '02033531295',
            'gender' => 'M',
            'status_id' => StatusService::get('general', 'A')->id,
            'user_id' => $user->id
        ]);
    }
}
