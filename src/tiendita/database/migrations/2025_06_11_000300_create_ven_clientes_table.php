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
        Schema::create('ven_clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apellido', 100)->nullable();
            $table->string('correo', 100)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->text('direccion')->nullable();
            $table->boolean('estado')->default(true);
            $table->foreignId('usuario_creo')->constrained('sis_usuarios');
            $table->timestamp('fecha_creo')->useCurrent();
            $table->foreignId('usuario_modifico')->nullable()->constrained('sis_usuarios');
            $table->timestamp('fecha_modifico')->nullable();
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
        Schema::dropIfExists('ven_clientes');
    }
};
