<?php

use App\Models\Ecommerce;
use App\Services\StatusService;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class EcommerceSeeder extends Seeder
{
    private $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = StatusService::get('general', 'A')->id;
        Ecommerce::query()->create([
            'name' => env('APP_NAME'),
            'description' => $this->faker->text(150),
            'status_id' => $status,
        ]);
    }
}
