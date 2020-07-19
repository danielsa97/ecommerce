<?php

use App\Models\Profile;
use App\Services\StatusService;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = StatusService::get('general', 'A')->id;
        $profile = Profile::query()->whereIn('name', ['customer', 'administrator'])->pluck('id', 'name');
        User::query()->firstOrCreate([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => 'password',
            'status_id' => $status,
            'remember_token' => Str::random(10),
            'profile_id' => $profile['administrator']
        ]);
        User::query()->firstOrCreate([
            'name' => 'Customer User Test',
            'email' => 'customer@customer.com',
            'email_verified_at' => now(),
            'password' => 'password',
            'status_id' => $status,
            'remember_token' => Str::random(10),
            'profile_id' => $profile['customer']
        ]);
    }
}
