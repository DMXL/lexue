<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddAvatarFieldsToLecturesTable extends Migration {

    /**
     * Make changes to the table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lectures', function(Blueprint $table) {

            $table->string('avatar_file_name')->nullable();
            $table->integer('avatar_file_size')->nullable()->after('avatar_file_name');
            $table->string('avatar_content_type')->nullable()->after('avatar_file_size');
            $table->timestamp('avatar_updated_at')->nullable()->after('avatar_content_type');

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

            $table->dropColumn('avatar_file_name');
            $table->dropColumn('avatar_file_size');
            $table->dropColumn('avatar_content_type');
            $table->dropColumn('avatar_updated_at');

        });
    }

}