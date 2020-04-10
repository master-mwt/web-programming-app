<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersSoftBannedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_soft_banned', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('channel_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('users_soft_banned', function (Blueprint $table){
            $table->unique(['user_id','channel_id']);

            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->foreign('channel_id')
                ->references('id')->on('channels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_soft_banned');
    }
}
