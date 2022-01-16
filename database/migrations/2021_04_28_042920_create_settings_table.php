<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->text('value')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });


        $settings = [
            [
                'key' => 'Whatsapp number'
            ],
            [
                'key' => 'Twitter'
            ],
            [
                'key'  => 'About Us'
            ],
            [
                'key'  => 'terms'
            ]
        ];

        foreach ($settings as  $value) {
            Setting::create($value);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
