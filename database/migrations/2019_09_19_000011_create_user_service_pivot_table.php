<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserServicePivotTable extends Migration
{
    public function up()
    {
        Schema::create('user_service', function (Blueprint $table) {
            $table->unsignedInteger('user_id');

            $table->foreign('user_id', 'user_id_fk_360622')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('service_id');

            $table->foreign('service_id', 'service_id_fk_360622')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_service');
    }
}
