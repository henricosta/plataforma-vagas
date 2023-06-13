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
        Schema::create('formacao', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('instituicao');
            $table->string('diploma');
            $table->string('area');
            $table->date('inicio');
            $table->date('termino')->nullable();
            $table->string('descricao', 3000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formacao');
    }
};
