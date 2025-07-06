<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->integer('bina_yasi');
            $table->integer('kat_sayisi');
            $table->string('kullanim_durumu');
            $table->string('hasar_durumu');
            $table->string('guvenlik');
            $table->string('asansor');
            $table->string('otopark');
            $table->unsignedBigInteger('post_id');
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buildings');
    }
};
