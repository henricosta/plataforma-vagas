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
        Schema::table('vagas', function(Blueprint $table) {
            $table->string('titulo', 255);
            $table->string('descricao', 3000);
            $table->foreignIdFor(\App\Models\Empresa::class);
            $table->unsignedInteger('num_vagas');
            $table->enum('modalidade', ['1', '2', '3']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vagas', function(Blueprint $table) {
            $table->dropColumn(['titulo', 'descricao', 'num_vagas', 'modalidade', 'empresa_id']);
        });
    }
};
