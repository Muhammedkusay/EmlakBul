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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('ad')->nullable();
            $table->string('soyad')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('kullanici_tipi');
            $table->unsignedBigInteger('tel')->nullable();
            $table->string('il')->nullable();
            $table->string('ilce')->nullable();
            $table->string('avatar')->nullable();
            $table->string('kurum_adi')->nullable();
            $table->timestamp('login_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
