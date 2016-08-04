<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorials', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students');

            $table->unsignedInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('teachers');

            $table->unsignedInteger('time_slot_id');
            $table->foreign('time_slot_id')->references('id')->on('time_slots');

            $table->date('date');

            $table->time('start')->comment('for sorting purposes only');

            $table->unique(['teacher_id', 'date', 'time_slot_id']);

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
        Schema::drop('tutorials');
    }
}
