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
        $profiles = [
            [
                "name" => "administrator",
                "description" => "profile to users Administrator",
                'status_id' => StatusService::get('general', 'A')->id,
            ],
            [
                "name" => "customer",
                "description" => "profile to users Customers",
                'status_id' => StatusService::get('general', 'A')->id,
            ]
        ];
        foreach ($profiles as $profile) {
            Profile::firstOrCreate($profile);
        }
    }
}
