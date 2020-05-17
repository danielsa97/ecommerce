<?php

use App\Models\Customer;
use App\Services\StatusService;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::query()->create([
            'name' => 'Daniel de Sá',
            'date_of_birth' => Carbon::now()->toDateString(),
            'document' => '02033531295',
            'gender_id' => StatusService::get('gender', 'M')->id,
            'status_id' => StatusService::get('general', 'A')->id
        ]);
    }
}
