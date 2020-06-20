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
            ProfileTableSeeder::class,
            UserSeeder::class,
        ]);

        //Fake Seeders
        if (env('APP_ENV') === 'local') {
            $this->call([
                CustomerSeeder::class,
            ]);
        }
    }
}
