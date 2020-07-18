<?php

use App\Models\Profile;
use App\Services\StatusService;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activeStatusId = StatusService::get('general', 'A')->id;
        $profiles = [
            [
                "name" => "administrator",
                "description" => "Profile to Administrator",
                'status_id' => $activeStatusId,
            ],
            [
                "name" => "customer",
                "description" => "Profile to Customers",
                'status_id' => $activeStatusId,
            ]
        ];
        foreach ($profiles as $profile) {
            Profile::query()->firstOrCreate($profile);
        }
    }
}
