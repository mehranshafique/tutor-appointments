<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('email');

            $table->bigInteger('phone')->nullable();

            $table->datetime('email_verified_at')->nullable();

            $table->string('password');

            $table->string('remember_token')->nullable();

            $table->string('introduction')->nullable();
            $table->integer('package_id')->nullable();
            $table->tinyInteger('user_type')->nullable();
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->string('google_id')->nullable();
            $table->string('avatar')->nullable();
            $table->string('status')->nullable();
            $table->string('credit')->nullable();
            $table->string('hourly_pay')->nullable();
            $table->string('location')->nullable();
            $table->integer('country')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
