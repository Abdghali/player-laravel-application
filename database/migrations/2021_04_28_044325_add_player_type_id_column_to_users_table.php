<?php

use App\Models\PlayerType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlayerTypeIdColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            if (config('database.default') == 'sqlite') {

                $table->foreignIdFor(PlayerType::class)->nullable()->constrained();
            } else {

                $table->foreignIdFor(PlayerType::class)->constrained();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
