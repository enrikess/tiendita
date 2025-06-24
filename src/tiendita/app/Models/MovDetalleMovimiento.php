<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovDetalleMovimiento extends Model
{
    protected $table = 'mov_detalle_movimientos';

    protected $fillable = [
        'movimiento_id',
        'producto_id',
        'lote_producto_id',
        'cantidad',
        'precio_unitario',
        'igv_porcentaje',
        'igv_monto',
        'subtotal',
        'total',
    ];

    public $timestamps = false;

    /**
     * Relación con el movimiento (mov_movimientos)
     */
    public function movimiento()
    {
        return $this->belongsTo(MovMovimiento::class, 'movimiento_id');
    }

    /**
     * Relación con el producto (inv_productos)
     */
    public function producto()
    {
        return $this->belongsTo(InvProducto::class, 'producto_id');
    }

    /**
     * Relación con el lote del producto (inv_lote_productos)
     */
    public function lote()
    {
        return $this->belongsTo(InvLoteProducto::class, 'lote_producto_id');
    }
}
