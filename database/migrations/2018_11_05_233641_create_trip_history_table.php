<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_history', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('on_board_status')->default(1);
            $table->integer('user_id')->unsigned();
            $table->integer('bus_id')->unsigned();
            $table->bigInteger('on_board_time');
            $table->bigInteger('exit_time')->nullable();
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
        Schema::dropIfExists('trip_history');
    }
}
