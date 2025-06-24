<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class MovMovimiento extends Model
{
    protected $table = 'mov_movimientos';

    protected $fillable = [
        'numero_movimiento',
        'tipo_movimiento_id',
        'referencia_tipo_id',
        'ubicacion_origen_id',
        'ubicacion_destino_id',
        'cantidad',
        'subtotal_movimiento',
        'igv_movimiento',
        'total_movimiento',
        'fecha_movimiento',
        'usuario_creo',
        'fecha_creo',
        'usuario_modifico',
        'fecha_modifico',
        'eliminado',
        'usuario_elimino',
        'motivo_elimino',
        'fecha_elimino',
        'estado',
    ];

    public $timestamps = false;

    /**
     * Retorna el número de movimiento con formato.
     * Ejemplo: MOV-00000123
     *
     * @return string
     */
    public function getNumeroMovimientoFormateadoAttribute(): string
    {
        return 'MOV-' . str_pad($this->numero_movimiento, 8, '0', STR_PAD_LEFT);
    }

    /**
     * Formatea la fecha del movimiento para mostrarla en Y-m-d H:i:s
     *
     * @return string|null
     */
    public function getFechaMovimientoFormateadaAttribute(): ?string
    {
        return $this->fecha_movimiento
            ? Carbon::parse($this->fecha_movimiento)->format('Y-m-d H:i:s')
            : null;
    }
}
