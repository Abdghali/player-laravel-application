<?php

namespace Database\Seeders;

use App\Models\Playground;
use Illuminate\Database\Seeder;

class PlaygroundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Playground::factory()->count(30)->create();
    }
}
