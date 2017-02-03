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

            $table->date('date');
            $table->time('start')->comment('for sorting purposes only');
            $table->unique(['teacher_id', 'date', 'start']);

            $table->string('name')->nullable();
            $table->smallInteger('length');
            $table->float('price');
            $table->text('description')->nullable();
            $table->boolean('enabled')->default(false);
            $table->boolean('finished')->default(false);
            $table->string('room_id')->nullable()->comment('端房间唯一id');
            $table->string('host_code')->nullable()->comment('主讲人邀请码');
            
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
        Schema::drop('lectures');
    }
}
