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
        Schema::create('lands', function (Blueprint $table) {
            $table->id();
            $table->integer('arsa_alani');
            $table->string('imar_durumu');
            $table->string('yol_durumu');
            $table->string('altyapi_durumu');
            $table->string('manzara');
            $table->string('arazi_egimi');
            $table->string('hukuki_durumu');
            $table->string('pazarlik_durumu');
            $table->bigInteger('post_id');
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lands');
    }
};
