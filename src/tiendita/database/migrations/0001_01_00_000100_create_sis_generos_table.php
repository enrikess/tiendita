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
        Schema::create('sis_generos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 2);
            $table->string('nombre', 50);
            $table->string('descripcion', 100)->nullable();
            $table->boolean('estado')->default(true);
        });

        // Agregar datos iniciales
        DB::table('sis_generos')->insert([
            ['codigo' => 'M', 'nombre' => 'Masculino', 'descripcion' => 'Género masculino'],
            ['codigo' => 'F', 'nombre' => 'Femenino', 'descripcion' => 'Género femenino'],
            ['codigo' => 'O', 'nombre' => 'Otro', 'descripcion' => 'Otro género'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sis_generos');
    }
};
