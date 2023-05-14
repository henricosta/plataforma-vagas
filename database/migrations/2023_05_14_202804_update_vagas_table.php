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
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('titulo');
            $table->dropColumn('data_nascimento');
            $table->dropColumn('descricao');
            $table->dropForeignIdFor(\App\Models\User::class);
            $table->dropColumn('num_vagas');
            $table->dropColumn('modalidade');
        });
    }
};
