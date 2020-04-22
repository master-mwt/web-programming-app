<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('size');
            $table->string('location');
            $table->string('caption')->nullable();
            $table->bigInteger('post_id')->unsigned()->nullable();
            $table->timestamps();
        });

        // Schema::table('images', function (Blueprint $table) {
        //     $table->foreign('post_id')
        //         ->references('id')->on('posts')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
