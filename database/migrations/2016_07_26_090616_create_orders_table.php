<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->string('trade_no', 32)->nullable();
            $table->string('transaction_id', 32)->nullable();

            $table->unsignedInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students');

            $table->unsignedInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('teachers');

            $table->unsignedInteger('lecture_id')->nullable();
            $table->foreign('lecture_id')->references('id')->on('lectures');
            $table->unique(['student_id', 'lecture_id']);

            $table->boolean('is_lecture');

            $table->float('total');
            $table->boolean('paid')->default(false);
            $table->timestamp('paid_at')->nullable();
            $table->boolean('cancelled')->default(false);
            $table->boolean('refunded')->default(false);

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
        Schema::drop('orders');
    }
}
