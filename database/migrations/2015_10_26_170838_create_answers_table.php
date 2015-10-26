<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id', false, true)->unsigned();
            $table->integer('question_id', false, true)->unsigned();
            $table->integer('option_id', false, true)->unsigned();
            $table->timestamps();

            $table->foreign('student_id')->references('id')
                  ->on('students')->onDelete('cascade');

            $table->foreign('question_id')->references('id')
                  ->on('questions')->onDelete('cascade');

            $table->foreign('option_id')->references('id')
                  ->on('options')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('answers');
    }
}
