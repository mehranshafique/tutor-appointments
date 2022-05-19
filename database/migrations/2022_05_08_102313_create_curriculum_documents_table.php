<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculum_documents', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('file_size');
            $table->string('file_type');
            $table->unsignedBigInteger('child_subject_id');
            $table->foreign('child_subject_id')->references('id')->on('child_subjects');
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
        Schema::dropIfExists('curriculum_documents');
    }
}
