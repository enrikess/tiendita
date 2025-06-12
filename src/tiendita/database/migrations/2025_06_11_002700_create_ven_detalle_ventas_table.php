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
        Schema::create('ven_detalle_ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_id')->constrained('ven_ventas');
            $table->foreignId('producto_id')->constrained('inv_productos');
            $table->decimal('cantidad', 10, 2);
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('igv_porcentaje', 5, 2);
            $table->decimal('igv_monto', 10, 2);
            $table->decimal('subtotal', 10, 2); // cantidad * precio_unitario
            $table->decimal('total', 10, 2);    // subtotal + igv_monto
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ven_detalle_ventas');
    }
};
