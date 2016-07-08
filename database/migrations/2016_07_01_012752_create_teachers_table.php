<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();

            $table->string('intro')->nullable();
            $table->string('degrees')->nullable();
            $table->string('careers')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('teaching_since')->nullable();
            $table->float('unit_price')->default(99);

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
        Schema::drop('teachers');
    }
}
