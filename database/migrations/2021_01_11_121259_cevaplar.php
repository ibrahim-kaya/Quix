<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cevaplar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cevaplar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->unsignedBigInteger('soru_id');
            $table->enum('cevap', ['cevap1', 'cevap2', 'cevap3', 'cevap4']);
            $table->timestamps();
            $table->foreign('soru_id')->references('id')->on('sorular')->onDelete('cascade');;
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cevaplar');
    }
}
