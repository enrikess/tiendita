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
        Schema::create('com_proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('ruc',20);
            $table->string('razon_social',100);
            $table->string('nombre_comercial',100)->nullable();
            $table->string('direccion',200)->nullable();
            $table->string('telefono',20)->nullable();
            $table->string('email',100)->nullable();
            $table->string('persona_contacto',100)->nullable();
            $table->boolean('estado')->default(true);
            $table->foreignId('usuario_creo')->constrained('sis_usuarios');
            $table->timestamp('fecha_creo')->useCurrent();
            $table->foreignId('usuario_modifico')->nullable()->constrained('sis_usuarios');
            $table->timestamp('fecha_modifico')->nullable()->useCurrent();
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
        Schema::dropIfExists('com_proveedores');
    }
};
