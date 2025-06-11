<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Clase para mantener compatibilidad con código existente
 * @deprecated Usar SisGenero en su lugar
 */
class Genero extends SisGenero
{
    use HasFactory;

    /**
     * Relación con personas que tienen este género
     * @deprecated Usar SisGenero::personas() en su lugar
     */
    public function personas()
    {
        return $this->hasMany(SisPersona::class, 'genero_id');
    }
}
