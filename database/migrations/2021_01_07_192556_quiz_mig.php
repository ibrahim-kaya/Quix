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
            $table->string('baslik');
            $table->string('aciklama')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->enum('durum', ['yayinda', 'taslak', 'silindi'])->default('taslak');
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
