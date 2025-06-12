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
        Schema::create('stk_stock_almacen_detallados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('inv_productos')->nullable();
            $table->foreignId('lote_id')->constrained('inv_lote_productos')->nullable();
            $table->decimal('cantidad', 10, 2)->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stk_stock_almacen_detallados');
    }
};
