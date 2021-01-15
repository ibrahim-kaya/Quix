<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuizMig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('uniqueid')->unique();
            $table->integer('olusturan_id');
            $table->string('baslik');
            $table->string('aciklama')->nullable();
            $table->string('kategori');
            $table->string('resim')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->integer('durum')->default('0');
            $table->integer('gizlilik')->default('0');
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
        Schema::dropIfExists('Quizzes');
    }
}
