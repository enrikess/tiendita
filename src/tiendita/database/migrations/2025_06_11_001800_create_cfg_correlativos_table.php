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
        Schema::create('cfg_correlativos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento', 50);
            $table->string('serie', 10)->default('001');
            $table->int('anio')->default(date('Y'));
            $table->int('ultimo_numero')->default(0);
            $table->int('fecha_actualizacion')->default(time());
            $table->boolean('estado')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cfg_correlativos');
    }
};
