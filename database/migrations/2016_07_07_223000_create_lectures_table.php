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

            $table->unsignedInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('teachers');

            $table->unsignedInteger('time_slot_id');
            $table->foreign('time_slot_id')->references('id')->on('time_slots');

            $table->date('date');

            $table->time('start')->comment('for sorting purposes only');

            $table->string('name')->nullable();

            $table->boolean('complete')->default(false);

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
        Schema::drop('lectures');
    }
}
