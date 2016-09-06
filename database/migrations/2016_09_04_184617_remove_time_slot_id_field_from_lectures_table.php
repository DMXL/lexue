<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveTimeSlotIdFieldFromLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lectures', function (Blueprint $table) {
            $table->dropForeign('lectures_time_slot_id_foreign');
            $table->dropForeign('lectures_teacher_id_foreign');
            $table->dropUnique(['teacher_id', 'date', 'time_slot_id']);
            $table->dropColumn('time_slot_id');

            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->unique(['teacher_id', 'date', 'start']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lectures', function (Blueprint $table) {
            $table->dropForeign('lectures_teacher_id_foreign');
            $table->dropUnique(['teacher_id', 'date', 'start']);

            $table->unsignedInteger('time_slot_id')->nullable();
            $table->foreign('time_slot_id')->references('id')->on('time_slots');
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->unique(['teacher_id', 'date', 'time_slot_id']);
        });
    }
}
