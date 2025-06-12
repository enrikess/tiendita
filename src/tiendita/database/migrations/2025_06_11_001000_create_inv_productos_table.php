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
        Schema::create('inv_productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50);
            $table->string('codigo_barras', 100)->nullable()->unique();
            $table->string('nombre', 100);
            $table->string('descripcion', 255)->nullable();

            $table->foreignId('categoria_id')->constrained('inv_categorias');
            $table->foreignId('subcategoria_id')->constrained('inv_subcategorias')->nullable();
            $table->foreignId('unidad_medida_id')->constrained('inv_unidad_medidas');
            $table->foreignId('marca_id')->constrained('inv_marcas')->nullable();

            $table->decimal('precio_compra', 10, 2);
            $table->decimal('precio_venta', 10, 2);

            $table->boolean('estado')->default(true);
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
        Schema::dropIfExists('inv_productos');
    }
};
