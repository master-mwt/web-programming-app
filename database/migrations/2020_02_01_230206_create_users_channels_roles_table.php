<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersChannelsRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_channels_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('channel_id')->unsigned();
            $table->bigInteger('role_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('users_channels_roles', function (Blueprint $table) {
            $table->unique(['user_id', 'channel_id']);

            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->foreign('channel_id')
                ->references('id')->on('channels');
            $table->foreign('role_id')
                ->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_channel_roles');
    }
}
