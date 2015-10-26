<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('score', false, true);
            $table->integer('quiz_id', false, true)->unsigned();
            $table->integer('student_id', false, true)->unsigned();
            $table->timestamps();

            $table->foreign('quiz_id')->references('id')
                  ->on('quizzes')->onDelete('cascade');

            $table->foreign('student_id')->references('id')
                  ->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('scores');
    }
}
