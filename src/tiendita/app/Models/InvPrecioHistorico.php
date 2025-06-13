<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvPrecioHistorico extends Model
{
    use HasFactory;

    protected $table = 'inv_precios_historicos';

    public $timestamps = false;

    protected $fillable = [
        'producto_id',
        'precio_compra',
        'precio_venta',
        'fecha_inicio',
        'fecha_fin'
    ];

    protected $casts = [
        'precio_compra' => 'decimal:2',
        'precio_venta' => 'decimal:2',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function producto()
    {
        return $this->belongsTo(InvProducto::class, 'producto_id');
    }
}
