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
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->integer('brut_metrekare');
            $table->integer('net_metrekare');
            $table->integer('oda_sayisi')->nullable();
            $table->integer('salon_sayisi')->nullable();
            $table->integer('banyo_sayisi')->nullable();
            $table->string('kat');
            $table->string('isitma_tipi');
            $table->string('esya_durumu')->nullable();
            $table->string('manzara')->nullable();
            $table->integer('balkon')->nullable();
            $table->string('teras')->nullable();
            $table->string('cephe')->nullable();
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
        Schema::dropIfExists('features');
    }
};
