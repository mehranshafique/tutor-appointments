<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom', function (Blueprint $table) {
            $table->string('uuid')->nullable();
            $table->bigInteger('id')->nullable();
            $table->unsignedInteger('assistant_id')->nullable();
            $table->unsignedInteger('teacher_id')->nullable();
            $table->unsignedInteger('appointment_id')->nullable();  
            $table->foreign('teacher_id', 'teacher_fk_360715')->references('id')->on('users');
            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id', 'student_360715')->references('id')->on('users');
            $table->string('host_id')->nullable();
            $table->string('host_email')->nullable();
            $table->string('topic')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->string('start_time')->nullable();
            $table->string('duration')->nullable();
            $table->string('timezone')->nullable();
            $table->string('agenda')->nullable();
            $table->string('start_url', 5000)->nullable();
            $table->string('join_url', 5000)->nullable();
            $table->string('password')->nullable();
            $table->string('h323_password')->nullable();
            $table->string('pstn_password')->nullable();
            $table->boolean('pre_schedule')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zoom');
    }
}
