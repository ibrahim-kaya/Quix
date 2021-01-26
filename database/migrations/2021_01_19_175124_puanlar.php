<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Puanlar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puanlar', function (Blueprint $table) {
            $table->id();
            $table->text('userid');
            $table->unsignedBigInteger('quizid');
            $table->integer('puan');
            $table->timestamps();
            $table->foreign('quizid')->references('id')->on('quizzes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Puanlar');
    }
}
