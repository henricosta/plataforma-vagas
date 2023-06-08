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
        Schema::table('candidaturas', function(Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('vaga_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vaga_id')->references('id')->on('vagas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidaturas', function(Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('candidaturas', function(Blueprint $table) {
            $table->dropColumn('vaga_id');
        });
    }
};
