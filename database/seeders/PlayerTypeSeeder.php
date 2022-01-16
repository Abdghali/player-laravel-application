<?php

namespace Database\Seeders;

use App\Models\PlayerType;
use Illuminate\Database\Seeder;

class PlayerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlayerType::factory()->count(5)->create();
    }
}
