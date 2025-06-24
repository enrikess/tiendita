<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepKardex extends Model
{
    protected $table = 'rep_kardexes';

    protected $fillable = [
        'producto_id',
        'lote_producto_id',
        'ubicacion_id',
        'fecha',
        'tipo_movimiento_id',
        'documento_referencia',
        'detalle',
        'cantidad_inicial',
        'valor_inicial',
        'cantidad_entrada',
        'valor_entrada',
        'cantidad_salida',
        'valor_salida',
        'cantidad_final',
        'valor_final',
        'costo_unitario',
        'usuario_id',
        'fecha_vencimiento',
        'observaciones',
        'referencia_tipo_id',
    ];

    public $timestamps = false;

    /**
     * Relación con el producto
     */
    public function producto()
    {
        return $this->belongsTo(InvProducto::class, 'producto_id');
    }

    /**
     * Relación con el lote del producto
     */
    public function lote()
    {
        return $this->belongsTo(InvLoteProducto::class, 'lote_producto_id');
    }

    /**
     * Relación con la ubicación
     */
    public function ubicacion()
    {
        return $this->belongsTo(InvUbicacion::class, 'ubicacion_id');
    }

    /**
     * Relación con el tipo de movimiento
     */
    public function tipoMovimiento()
    {
        return $this->belongsTo(MovTipoMovimiento::class, 'tipo_movimiento_id');
    }

    /**
     * Relación con el usuario
     */
    public function usuario()
    {
        return $this->belongsTo(SisUsuario::class, 'usuario_id');
    }

    /**
     * Relación con el tipo de referencia (opcional)
     */
    public function referenciaTipo()
    {
        return $this->belongsTo(CfgReferenciaTipo::class, 'referencia_tipo_id');
    }
}