<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DuelloSorular extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duello_sorular', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('duello_id');
            $table->unsignedBigInteger('soru_id');
            $table->timestamps();
            $table->foreign('duello_id')->references('id')->on('duello')->onDelete('cascade');
            $table->foreign('soru_id')->references('id')->on('sorular')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('duello_sorular');
    }
}
