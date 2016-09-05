<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoomIdAndOther2FieldsToLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lectures', function (Blueprint $table) {
            $table->string('room_id')->nullable()->after('finished')->comment('PC端房间唯一id');
            $table->string('host_code')->nullable()->after('room_id')->comment('主讲人邀请码');
            $table->string('wechat_room_id')->nullable()->after('host_code')->comment('微信端房间唯一id');
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
            $table->dropColumn(['room_id', 'host_code', 'wechat_room_id']);
        });
    }
}
