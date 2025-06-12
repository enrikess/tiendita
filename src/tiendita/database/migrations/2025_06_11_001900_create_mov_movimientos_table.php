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
        Schema::create('mov_movimientos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_movimiento', 20)->unique();
            $table->foreignId('tipo_movimiento_id')->constrained('mov_tipo_movimientos');
            $table->foreignId('referencia_tipo_id')->constrained('cfg_referencia_tipos');
            $table->foreignId('ubicacion_origen_id')->nullable()->constrained('inv_ubicaciones');
            $table->foreignId('ubicacion_destino_id')->nullable()->constrained('inv_ubicaciones');
            $table->decimal('cantidad', 10, 2);
            $table->decimal('subtotal_movimiento', 10, 2);
            $table->decimal('igv_movimiento', 10, 2);
            $table->decimal('total_movimiento', 10, 2);
            $table->timestamp('fecha_movimiento')->useCurrent();
            $table->foreignId('usuario_creo')->constrained('sis_usuarios');
            $table->timestamp('fecha_creo')->useCurrent();
            $table->foreignId('usuario_modifico')->nullable()->constrained('sis_usuarios');
            $table->timestamp('fecha_modifico')->nullable()->useCurrentOnUpdate();
            $table->boolean('eliminado')->default(false);
            $table->foreignId('usuario_elimino')->nullable()->constrained('sis_usuarios');
            $table->string('motivo_elimino', 50)->nullable();
            $table->timestamp('fecha_elimino')->nullable();
            $table->boolean('estado')->default(true);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mov_movimientos');
    }
};
