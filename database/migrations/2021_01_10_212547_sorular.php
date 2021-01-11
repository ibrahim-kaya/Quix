<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sorular extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sorular', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_id');
            $table->string('soru');
            $table->text('resim')->nullable();
            $table->text('cevap1');
            $table->text('cevap2');
            $table->text('cevap3');
            $table->text('cevap4');
            $table->enum('dogru_cevap', ['cevap1', 'cevap2', 'cevap3', 'cevap4']);
            $table->timestamps();
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sorular');
    }
}
