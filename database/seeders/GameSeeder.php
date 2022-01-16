<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // running 
        Game::factory()->count(30)->create();


        // running finished.
        Game::factory()->count(30)->create([
            'start'          => now()->subDay(random_int(5, 10)),
        ]);


        // waiting
        Game::factory()->waiting()->count(30)->create();
    }
}
