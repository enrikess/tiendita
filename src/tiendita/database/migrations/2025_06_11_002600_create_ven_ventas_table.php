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
        Schema::create('ven_ventas', function (Blueprint $table) {
            $table->id();
            $table->string('numero_venta', 20)->unique();
            $table->foreignId('cliente_id')->constrained('ven_clientes');
            $table->timestamp('fecha_venta')->nullable();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('igv_total', 10, 2);
            $table->decimal('total', 10, 2);
            $table->foreignId('metodo_pago_id')->constrained('fin_metodo_pagos');
            $table->foreignId('estado_venta_id')->constrained('ven_estado_ventas');
            $table->foreignId('usuario_creo')->constrained('sis_usuarios');
            $table->timestamp('fecha_creo')->useCurrent();
            $table->foreignId('usuario_modifico')->nullable()->constrained('sis_usuarios');
            $table->timestamp('fecha_modifico')->nullable()->useCurrentOnUpdate();
            $table->boolean('eliminado')->default(false);
            $table->foreignId('usuario_elimino')->nullable()->constrained('sis_usuarios');
            $table->string('motivo_elimino', 50)->nullable();
            $table->timestamp('fecha_elimino')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ven_ventas');
    }
};
