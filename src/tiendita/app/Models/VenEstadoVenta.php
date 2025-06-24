<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VenEstadoVenta extends Model
{
    protected $table = 'ven_estado_ventas';

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'estado',
    ];

    public $timestamps = false;

    /**
     * Accesor para retornar el nombre del estado de venta
     *
     * @return string
     */
    public function getNombreEstadoAttribute(): string
    {
        return $this->nombre ?? '';
    }
}
