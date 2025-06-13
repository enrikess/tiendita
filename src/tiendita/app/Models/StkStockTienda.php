<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StkStockTienda extends Model
{
    use HasFactory;

    protected $table = 'stk_stock_tiendas';

    public $timestamps = false;

    protected $fillable = [
        'producto_id',
        'cantidad'
    ];

    protected $casts = [
        'cantidad' => 'decimal:2',
    ];

    public function producto()
    {
        return $this->belongsTo(InvProducto::class, 'producto_id');
    }
}
