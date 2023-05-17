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
        // TODO: criar model de cidades e montar relacionamento
        Schema::table('vagas', function(Blueprint $table) {
            $table->unsignedInteger('cidade_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vagas', function(Blueprint $table) {
            $table->dropColumn('cidade_id');
        });
    }
};
