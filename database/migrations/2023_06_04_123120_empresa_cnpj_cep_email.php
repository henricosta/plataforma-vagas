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
        Schema::table('empresas', function(Blueprint $table) {
            $table->string('telefone');
            $table->string('cnpj');
            $table->string('cep');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empresas', function(Blueprint $table) {
            $table->dropColumn('telefone');
        });
        Schema::table('empresas', function(Blueprint $table) {
            $table->dropColumn('cnpj');
        });
        Schema::table('empresas', function(Blueprint $table) {
            $table->dropColumn('cep');
        });
    }
};
