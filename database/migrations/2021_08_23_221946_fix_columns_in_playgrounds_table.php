<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixColumnsInPlaygroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('playgrounds', function (Blueprint $table) {
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('playgrounds', function (Blueprint $table) {
            //
        });
    }
}
