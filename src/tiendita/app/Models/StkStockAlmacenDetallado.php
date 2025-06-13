<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StkStockAlmacenDetallado extends Model
{
    use HasFactory;

    protected $table = 'stk_stock_almacen_detallado';

    public $timestamps = false;

    protected $fillable = [
        'producto_id',
        'cantidad',
        'almacen_id'
    ];

    protected $casts = [
        'cantidad' => 'decimal:2',
    ];

    public function producto()
    {
        return $this->belongsTo(InvProducto::class, 'producto_id');
    }

        public function lote()
    {
        return $this->belongsTo(InvLoteProducto::class, 'lote_id');
    }

}
