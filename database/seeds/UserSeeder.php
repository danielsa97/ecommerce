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
        User::query()->firstOrCreate([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => 'password',
            'status_id' => StatusService::get('general', 'A')->id,
            'remember_token' => Str::random(10),
            'profile_id' => Profile::whereName('administrator')->first()->id
        ]);

    }
}
