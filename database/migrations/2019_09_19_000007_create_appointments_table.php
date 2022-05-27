<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->datetime('start_time');

            $table->datetime('finish_time');

            $table->decimal('price', 15, 2)->nullable();

            $table->tinyInteger('status')->default('0');
            $table->longText('comments')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
