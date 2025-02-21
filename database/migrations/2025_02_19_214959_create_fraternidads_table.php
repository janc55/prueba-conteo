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
        Schema::create('fraternidades', function (Blueprint $table) { // 🔥 Nombre corregido
            $table->id();
            $table->string('nombre');
            $table->string('tipo_danza');
            $table->integer('cantidad_integrantes')->default(0);
            $table->integer('bloques')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fraternidads');
    }
};
