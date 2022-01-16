<?php

use App\Models\RestoreFee;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestoreFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restore_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('status')->default(RestoreFee::UNSEEN);
            $table->foreignIdFor(User::class)->constrained();
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
        Schema::dropIfExists('restore_fees');
    }
}
