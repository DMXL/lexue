<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoomIdAndHostCodeFieldToLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lectures', function (Blueprint $table) {
            $table->string('room_id')->nullable()->after('finished')->comment('端房间唯一id');
            $table->string('host_code')->nullable()->after('room_id')->comment('主讲人邀请码');
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
            $table->dropColumn(['room_id', 'host_code']);
        });
    }
}
