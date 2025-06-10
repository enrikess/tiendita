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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('ruc',20);
            $table->string('razon_social',100);
            $table->string('nombre_comercial',100);
            $table->string('direccion',200);
            $table->string('telefono',20);
            $table->string('email',100);
            $table->string('persona_contacto',100);
            $table->boolean('estado')->default(true);
            $table->int('usuario_creo');
            $table->timestamp('fecha_creo')->useCurrent();
            $table->int('usuario_modifico');
            $table->timestamp('fecha_modifico')->useCurrent();
            $table->boolean('eliminado')->default(false);
            $table->int('usuario_elimino');
            $table->varchar('motivo_elimino');
            $table->timestamp('fecha_elimino');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
