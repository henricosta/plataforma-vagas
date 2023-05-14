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
        Schema::table('users', function(Blueprint $table) {
            $table->renameColumn('name', 'nome_completo');
        });
        Schema::table('users', function(Blueprint $table) {
            $table->date('data_nascimento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $table) {
            $table->renameColumn('nome_completo', 'name');
        });

        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('data_nascimento');
        });
    }
};
