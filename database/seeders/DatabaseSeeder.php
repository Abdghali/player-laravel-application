<?php

namespace Database\Seeders;

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
            AdminSeeder::class,
            PlayerTypeSeeder::class,
            CitySeeder::class,
            PlaygroundSeeder::class,
            ApplicationSeeder::class,
            RestoreFeeSeeder::class,
            GameSeeder::class,
            UserSeeder::class,
            AssignUsersToGames::class,
            MediaSeeder::class
        ]);
    }
}
