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
        Schema::create('rep_kardexes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('inv_productos');
            $table->foreignId('lote_producto_id')->nullable()->constrained('inv_lote_productos');
            $table->foreignId('ubicacion_id')->constrained('inv_ubicaciones');
            $table->timestamp('fecha')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignId('tipo_movimiento_id')->constrained('mov_tipo_movimientos');
            $table->string('documento_referencia', 30);
            $table->string('detalle', 100);
            $table->decimal('cantidad_inicial', 10, 2);
            $table->decimal('valor_inicial', 10, 2);
            $table->decimal('cantidad_entrada', 10, 2)->default(0);
            $table->decimal('valor_entrada', 10, 2)->default(0);
            $table->decimal('cantidad_salida', 10, 2)->default(0);
            $table->decimal('valor_salida', 10, 2)->default(0);
            $table->decimal('cantidad_final', 10, 2);
            $table->decimal('valor_final', 10, 2);
            $table->decimal('costo_unitario', 10, 2);
            $table->foreignId('usuario_id')->constrained('sis_usuarios');
            $table->date('fecha_vencimiento')->nullable();
            $table->string('observaciones', 200);
            $table->foreignId('referencia_tipo_id')->nullable()->constrained('cfg_referencia_tipos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rep_kardexes');
    }
};
