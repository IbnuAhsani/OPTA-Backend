<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopUpRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_up_request', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('accepted_status')->default(0);
            $table->integer('unique_code');
            $table->integer('nominal');
            $table->bigInteger('request_time');
            $table->bigInteger('expire_time');
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('top_up_request');
    }
}
