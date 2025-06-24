<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VenDetalleVenta extends Model
{
    protected $table = 'ven_detalle_ventas';

    protected $fillable = [
        'venta_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'igv_porcentaje',
        'igv_monto',
        'subtotal',
        'total',
    ];

    public $timestamps = false;

    /**
     * Relación con la venta (ven_ventas)
     */
    public function venta()
    {
        return $this->belongsTo(VenVenta::class, 'venta_id');
    }

    /**
     * Relación con el producto (inv_productos)
     */
    public function producto()
    {
        return $this->belongsTo(InvProducto::class, 'producto_id');
    }
}
