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
        Schema::create('conteos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fraternidad_id')->constrained('fraternidades')->onDelete('cascade');
            $table->foreignId('banda_id')->nullable()->constrained('bandas')->onDelete('cascade');
            $table->integer('cantidad_integrantes');
            $table->integer('bloques');
            $table->enum('ubicacion', ['Av. 6 de agosto', 'Plaza']);
            $table->enum('turno', ['mañana', 'tarde', 'noche', 'amanecer']);
            $table->foreignId('contador_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conteos');
    }
};
