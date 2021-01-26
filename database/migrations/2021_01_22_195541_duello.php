<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Duello extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duello', function (Blueprint $table) {
            $table->id();
            $table->string('uniqueid')->unique();
            $table->unsignedBigInteger('olusturan_id');
            $table->unsignedBigInteger('rakip_id');
            $table->string('kategori');
            $table->timestamp('expires_at');
            $table->integer('kabul')->default('0');
            $table->timestamps();
            $table->foreign('olusturan_id')->references('id')->on('users');
            $table->foreign('rakip_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('duello');
    }
}
