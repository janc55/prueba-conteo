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
        Schema::table('fraternidades', function (Blueprint $table) {
            $table->integer('grupo')->nullable()->after('id'); // 🔥 Agregar el campo grupo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fraternidades', function (Blueprint $table) {
            $table->dropColumn('grupo');
        });
    }
};
