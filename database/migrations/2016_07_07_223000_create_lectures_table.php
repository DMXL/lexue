<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lectures', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students');

            $table->unsignedInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('teachers');

            $table->boolean('complete')->default(false);

            $table->boolean('single')->default(false);

            $table->timestamp('start_at');

            $table->unique(['teacher_id', 'start_at']);
            
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
        Schema::drop('lectures');
    }
}
