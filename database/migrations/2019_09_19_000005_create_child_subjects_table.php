<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('child_subjects', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->integer('subject_id');

            $table->string('picture')->nullable();

            $table->string('description')->nullable();

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

        Schema::dropIfExists('child_subjects');
    }
}
