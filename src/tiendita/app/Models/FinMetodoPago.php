<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinMetodoPago extends Model
{
    protected $table = 'fin_metodo_pagos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    public $timestamps = false;

    /**
     * Retorna el nombre del método de pago
     *
     * @return string
     */
    public function getNombreMetodoPagoAttribute(): string
    {
        return $this->nombre ?? '';
    }
}
