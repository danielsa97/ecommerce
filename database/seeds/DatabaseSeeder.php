<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StatusSeeder::class,
            EcommerceSeeder::class,
            ProfileTableSeeder::class,
            UserSeeder::class,
            NationsSeeder::class,
            BrazilStatesSeeder::class,
            BrazilCitiesSeeder::class,
        ]);

        //Fake Seeders
        if (env('APP_ENV') === 'local') {
            $this->call([
                CustomerSeeder::class,
            ]);
        }
    }
}
