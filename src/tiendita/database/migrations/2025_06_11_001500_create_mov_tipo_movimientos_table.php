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
        Schema::create('mov_tipo_movimientos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',20)->unique();
            $table->string('nombre',100);
            $table->string('descripcion',255)->nullable();
            $table->char('afecta_stock');
            $table->boolean('estado')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mov_tipo_movimientos');
    }
};
