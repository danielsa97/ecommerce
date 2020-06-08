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
        $user = User::firstOrCreate(
            [
                'name' => 'Daniel de Sá',
                'email' => 'daniel@customers.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'status_id' => StatusService::get('general', 'A')->id,
                'remember_token' => Str::random(10),
                'profile_id' => Profile::whereName('customer')->first()->id
            ]
        );
        Customer::query()->firstOrCreate([
            'name' => 'Daniel de Sá',
            'date_of_birth' => Carbon::now()->toDateString(),
            'document' => '02033531295',
            'gender' => 'M',
            'status_id' => StatusService::get('general', 'A')->id,
            'user_id' => $user->id
        ]);
    }
}
