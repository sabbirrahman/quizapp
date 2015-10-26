<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorrectanswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correctanswers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id', false, true)->unsigned();
            $table->integer('option_id', false, true)->unsigned();
            $table->timestamps();

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
        Schema::drop('correctanswers');
    }
}
