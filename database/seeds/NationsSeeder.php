<?php

use App\Models\Nation;
use Illuminate\Database\Seeder;

class NationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nations = [
            [
                'name' => 'Brasil',
                'prefix' => 'BR'
            ]
        ];

        foreach ($nations as $nation) {
            Nation::query()->firstOrCreate($nation);
        }
    }
}
