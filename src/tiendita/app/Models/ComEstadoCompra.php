<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComEstadoCompra extends Model
{
    protected $table = 'com_estado_compras';

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'estado',
    ];

    public $timestamps = false;

    /**
     * Retorna el nombre del estado (útil para vistas o API)
     *
     * @return string
     */
    public function getNombreEstadoAttribute(): string
    {
        return $this->nombre ?? '';
    }
}
