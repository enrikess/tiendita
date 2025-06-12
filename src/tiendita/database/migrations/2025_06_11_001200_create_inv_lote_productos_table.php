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
        Schema::create('inv_lote_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('inv_productos')->nullable();
            $table->decimal('cantidad', 10, 2);
            $table->string('lote', 50)->nullable(); // Lote del producto
            $table->date('fecha_vencimiento')->nullable(); // Fecha de fabricación del producto
            $table->boolean('estado')->default(true); // Estado del lote
            $table->foreignId('usuario_creo')->constrained('sis_usuarios');
            $table->timestamp('fecha_creo')->useCurrent();
            $table->foreignId('usuario_modifico')->nullable()->constrained('sis_usuarios');
            $table->timestamp('fecha_modifico')->useCurrent();
            $table->boolean('eliminado')->default(false);
            $table->foreignId('usuario_elimino')->nullable()->constrained('sis_usuarios');
            $table->string('motivo_elimino', 100)->nullable();
            $table->timestamp('fecha_elimino')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_lote_productos');
    }
};
