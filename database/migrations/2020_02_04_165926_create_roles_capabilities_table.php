<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesCapabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_capabilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('role_id')->unsigned();
            $table->bigInteger('capability_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('roles_capabilities', function (Blueprint $table) {
            $table->unique(['role_id','capability_id']);
            
            $table->foreign('role_id')
                ->references('id')->on('roles');
            $table->foreign('capability_id')
                ->references('id')->on('capabilities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_capabilities');
    }
}
