<?php

namespace Database\Seeders;

use App\Models\{User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (config('database.default') == 'sqlite') {
            return;
        }

        $models = [User::class];

        foreach ($models as $model) {
            echo "\nStart faking images for {$model} \n";
            foreach ($model::cursor() as $item) {
                $item->addMediaFromString(Http::get('https://loremflickr.com/320/240')->body())
                    ->usingFileName('image.jpg')
                    ->toMediaCollection();
            }
            echo "\nFinished faking images for {$model} \n";
        }
    }
}
