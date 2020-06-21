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
        User::query()->firstOrCreate([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => 'password',
            'status_id' => $status,
            'remember_token' => Str::random(10),
            'profile_id' => Profile::whereName('administrator')->first()->id
        ]);
        User::query()->firstOrCreate([
            'name' => 'Daniel de Sá',
            'email' => 'customer@customer.com',
            'email_verified_at' => now(),
            'password' => 'password',
            'status_id' => $status,
            'remember_token' => Str::random(10),
            'profile_id' => Profile::whereName('customer')->first()->id
        ]);
        //Seta imagem padrao a todos os usuarios
        User::all()->each(function (User $user) use ($status) {
            $user->image()->create([
                'url' => env('APP_URL') . '/storage/images/user/user.svg',
                'status_id' => $status
            ]);
        });
    }
}
