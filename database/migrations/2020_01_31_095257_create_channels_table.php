<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('title');
            $table->text('description');
            $table->text('rules');
            $table->bigInteger('image_id')->unsigned()->nullable();
            $table->bigInteger('creator_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('channels', function (Blueprint $table) {
            $table->foreign('image_id')
                ->references('id')->on('images');
            $table->foreign('creator_id')
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
        Schema::dropIfExists('channels');
    }
}
