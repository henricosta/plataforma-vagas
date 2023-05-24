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
        Schema::create('user_competencia', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('competencia_id')->references('id')->on('competencias');
        });
    }

    /**user_competencia
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_competencia');
    }
};
