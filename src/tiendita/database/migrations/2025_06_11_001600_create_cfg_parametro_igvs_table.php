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
        Schema::create('cfg_parametro_igvs', function (Blueprint $table) {
            $table->id();
            $table->decimal('porcentaje', 5, 2)->default(18.00); // Porcentaje del IGV
            $table->date('fecha_inicio')->nullable(); // Fecha de inicio de vigencia
            $table->date('fecha_fin')->nullable(); // Fecha de fin de vigencia
            $table->boolean('activo')->default(true); // Indica si el parámetro está activo
            $table->foreignId('usuario_creo')->constrained('sis_usuarios');
            $table->timestamp('fecha_creo')->useCurrent();
            $table->foreignId('usuario_modifico')->nullable()->constrained('sis_usuarios');
            $table->timestamp('fecha_modifico')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cfg_parametro_igvs');
    }
};
