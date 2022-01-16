<?php

namespace Database\Seeders;

use App\Models\RestoreFee;
use Illuminate\Database\Seeder;

class RestoreFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RestoreFee::factory()->count(10)->create();

    }
}
