<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('role_id')->unsigned();
            $table->bigInteger('service_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('roles_services', function (Blueprint $table) {
            $table->unique(['role_id', 'service_id']);

            $table->foreign('role_id')
                ->references('id')->on('roles');
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
        Schema::dropIfExists('role_services');
    }
}
