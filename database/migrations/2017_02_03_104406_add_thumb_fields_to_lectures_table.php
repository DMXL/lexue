<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddThumbFieldsToLecturesTable extends Migration {

    /**
     * Make changes to the table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lectures', function(Blueprint $table) {

            $table->string('thumb_file_name')->nullable();
            $table->integer('thumb_file_size')->nullable()->after('thumb_file_name');
            $table->string('thumb_content_type')->nullable()->after('thumb_file_size');
            $table->timestamp('thumb_updated_at')->nullable()->after('thumb_content_type');

        });

    }

    /**
     * Revert the changes to the table.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lectures', function(Blueprint $table) {

            $table->dropColumn('thumb_file_name');
            $table->dropColumn('thumb_file_size');
            $table->dropColumn('thumb_content_type');
            $table->dropColumn('thumb_updated_at');

        });
    }

}