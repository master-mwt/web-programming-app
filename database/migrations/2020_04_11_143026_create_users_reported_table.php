<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersReportedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_reported', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('channel_id')->unsigned();
            $table->bigInteger('reported_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('users_reported', function (Blueprint $table){
            $table->unique(['user_id','channel_id']);

            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->foreign('channel_id')
                ->references('id')->on('channels')->onDelete('cascade');
            $table->foreign('reported_by')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_reported');
    }
}
