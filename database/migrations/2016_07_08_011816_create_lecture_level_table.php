<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLectureLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecture_level', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('lecture_id');
            $table->foreign('lecture_id')->references('id')->on('lectures')->onDelete('cascade');

            $table->unsignedInteger('level_id');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lecture_level');
    }
}
