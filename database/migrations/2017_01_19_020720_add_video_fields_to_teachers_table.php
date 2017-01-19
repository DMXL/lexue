<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddVideoFieldsToTeachersTable extends Migration {

    /**
     * Make changes to the table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teachers', function(Blueprint $table) {

            $table->string('video_file_name')->nullable();
            $table->integer('video_file_size')->nullable()->after('video_file_name');
            $table->string('video_content_type')->nullable()->after('video_file_size');
            $table->timestamp('video_updated_at')->nullable()->after('video_content_type');

        });

    }

    /**
     * Revert the changes to the table.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teachers', function(Blueprint $table) {

            $table->dropColumn('video_file_name');
            $table->dropColumn('video_file_size');
            $table->dropColumn('video_content_type');
            $table->dropColumn('video_updated_at');

        });
    }

}