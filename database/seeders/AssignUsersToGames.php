<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Seeder;

class AssignUsersToGames extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Game::all() as $game) {
            $game->users()->syncWithoutDetaching(User::inRandomOrder()->take(rand(5, 12))->get('id'));
        }
    }
}
