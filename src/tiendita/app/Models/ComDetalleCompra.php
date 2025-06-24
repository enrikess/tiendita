<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComDetalleCompra extends Model
{
    protected $table = 'com_detalle_compras';

    protected $fillable = [
        'compra_id',
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
     * Relación con la compra (com_compras)
     */
    public function compra()
    {
        return $this->belongsTo(ComCompra::class, 'compra_id');
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
