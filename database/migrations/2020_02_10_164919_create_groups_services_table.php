<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('group_id')->unsigned();
            $table->bigInteger('service_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('groups_services', function (Blueprint $table){
            $table->unique(['group_id','service_id']);

            $table->foreign('group_id')
                ->references('id')->on('groups');
            $table->foreign('service_id')
                ->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_services');
    }
}
