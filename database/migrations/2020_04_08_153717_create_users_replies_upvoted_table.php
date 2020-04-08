<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersRepliesUpvotedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_replies_upvoted', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('reply_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('users_replies_upvoted', function (Blueprint $table){
            $table->unique(['user_id','reply_id']);

            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->foreign('reply_id')
                ->references('id')->on('replies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_replies_upvoted');
    }
}
