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
        Schema::create('sis_tipo_documentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('abreviatura', 10)->nullable();
            $table->boolean('estado')->default(true);
        });
        // Agregar datos iniciales
        DB::table('sis_tipo_documentos')->insert([
            ['nombre' => 'DNI', 'abreviatura' => 'DNI'],
            ['nombre' => 'Pasaporte', 'abreviatura' => 'PAS'],
            ['nombre' => 'Carnet de Extranjería', 'abreviatura' => 'CE'],
            ['nombre' => 'Registro Único de Contribuyentes', 'abreviatura' => 'RUC']
        ]);

        Schema::create('sis_persona', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('ape_paterno', 50);
            $table->string('ape_materno', 50);
            $table->string('email', 50);
            $table->foreignId('tipo_documento_id')->nullable()->index()->constrained('sis_tipo_documentos');
            $table->string('numero_documento', 20)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('direccion', 100)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->foreignId('genero_id')->nullable()->index()->constrained('sis_generos');
            $table->boolean('estado')->default(true);
        });

        Schema::create('sis_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('persona_id')->nullable()->index()->constrained('sis_persona');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index()->constrained('sis_usuarios');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sis_usuarios');
        Schema::dropIfExists('sis_persona');
        Schema::dropIfExists('sis_tipo_documentos');
    }
};
