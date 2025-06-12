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
        Schema::create('cfg_referencia_tipos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 30)->unique(); // Código único de la referencia
            $table->string('nombre', 100); // Nombre de la referencia
            $table->string('descripcion', 200)->nullable(); // Descripción opcional de la referencia
            $table->boolean('estado')->default(true); // Estado activo/inactivo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cfg_referencia_tipos');
    }
};
