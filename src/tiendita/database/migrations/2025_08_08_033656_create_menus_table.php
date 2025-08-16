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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del menú o submenú
            $table->string('ruta')->nullable(); // Nombre de la ruta Laravel (opcional si es contenedor)
            $table->string('icono')->nullable(); // Clase CSS de icono
            $table->string('permiso')->nullable(); // Permiso de Spatie
            $table->unsignedBigInteger('parent_id')->nullable(); // Padre del submenú
            $table->integer('orden')->default(0); // Orden de aparición
            $table->timestamps();

            // Relación recursiva (un menú puede tener submenús)
            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
