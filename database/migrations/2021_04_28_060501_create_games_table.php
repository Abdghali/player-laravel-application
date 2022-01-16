<?php

use App\Models\Admin;
use App\Models\Playground;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->float('fees');
            $table->dateTime('start');
            $table->unsignedBigInteger('max_players');
            $table->foreignIdFor(Admin::class)->constrained();
            $table->foreignIdFor(Playground::class)->constrained();
            $table->text('description');
            // waiting game or running game.
            $table->unsignedTinyInteger('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
