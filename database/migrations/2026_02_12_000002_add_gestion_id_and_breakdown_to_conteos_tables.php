<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('conteos', function (Blueprint $table) {
            $table->foreignId('gestion_id')->nullable()->constrained('gestiones')->onDelete('cascade');
            $table->integer('varones')->default(0);
            $table->integer('mujeres')->default(0);
        });

        Schema::table('conteo_bandas', function (Blueprint $table) {
            $table->foreignId('gestion_id')->nullable()->constrained('gestiones')->onDelete('cascade');
            $table->integer('varones')->default(0);
            $table->integer('mujeres')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('conteos', function (Blueprint $table) {
            $table->dropForeign(['gestion_id']);
            $table->dropColumn(['gestion_id', 'varones', 'mujeres']);
        });

        Schema::table('conteo_bandas', function (Blueprint $table) {
            $table->dropForeign(['gestion_id']);
            $table->dropColumn(['gestion_id', 'varones', 'mujeres']);
        });
    }
};
